<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\WaitingLabNotification;
use Illuminate\Database\Eloquent\SoftDeletes;


class Invoice extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
        'approved_date'  => 'date:D M d Y',
    ];

    public static function booted()
    {
        static::creating(function ($model){
//            $revenue_serial_no = Revenue::get()->last()->serial_no ?? null;
//            if($revenue_serial_no != null){
//                $without_year = substr($revenue_serial_no, 4);
//            }
//
//            $model->serial_no = isset($revenue_serial_no) ? date("Y") . ++$without_year : date("Y") . '11111' . '10000';
            $model->employee_id = auth()->id();
            $model->barcode = substr(time(), -5) . mt_rand(0, 9);
            $model->serial_no = substr(time(), -10) . mt_rand(11, 99);


            $cost = 0;
            foreach ($model->waiting_labs as $waitingLab){
                $main = $waitingLab->main_analysis;
                $cost += $main->cost;
            }
            $model->total_cost = $cost;

        });
        static::created(function ($invoice){



//            Revenue::create([
//                'type' => config('enums.revenueType.invoice'), // invoice revenue
//                'invoice_id' => $model->id,
//                'amount' => $model->total_price,
//                'employee_id' => auth()->id(),
//                'serial_no'    => $model->serial_no
//            ]);

        });

    }
    
    public function patient()
    {
        return $this->belongsTo(Patient::class)->withTrashed();
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class)->withTrashed();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function doctor()
    {
//        dd(Doctor::find($this->doctor_id));
        return $this->belongsTo(Doctor::class, 'doctor_id')->withTrashed();
    }
    public function waiting_labs()
    {
        return $this->hasMany(WaitingLab::class,'invoice_id');
    }

    public function promo_code()
    {
        return $this->belongsTo(PromoCode::class);
    }


    
    public function calculateTotalPrice(&$responseArray)
    {
        $price = 0;
        $mainAnalysis = MainAnalysis::whereIn('id', request()->main_analysis_id??[])->get();
        $packages = Package::whereIn('id', request()->package_id??[])->get();
        $purchases = [];

        switch (request()->transfer){
            case config('enums.transfer.contract'):
                foreach ($mainAnalysis as $analysis) {
                    $price += $analysis->price_insurance;
                    $purchases[$analysis->general_name] = ['price' => $analysis->price_insurance, 'code' => $analysis->code, 'discount' => 0];
                }
                break;
            case config('enums.transfer.hospital'):

                $hospital = Hospital::find(request()->hospital_id);
                $hospitalMainAnalysis = $hospital->getMainAnalysesFromRequest();

                /** get all main analysis except hospital analysis **/
                $main_analysis = MainAnalysis::getMainAnalysesExcept($hospitalMainAnalysis->pluck('id')->toArray());
                $main_analysis = $main_analysis->merge($hospitalMainAnalysis);

                foreach ($main_analysis as $analysis) {
                    $price += $analysis['price'];
                    $purchases[$analysis['general_name']] = ['price' => $analysis['price'], 'code' => $analysis['code'], 'discount' => 0];
                }
                break;
            case config('enums.transfer.sector'):
                foreach ($mainAnalysis as $analysis) {
                    $price += $analysis->price;
                    $purchases[$analysis->general_name] = ['price' => $analysis->price, 'code' => $analysis->code, 'discount' => 0];
                }
                break;
            default :
                foreach ($mainAnalysis as $analysis) {
                    $price += $analysis->price - $analysis->discount;
                    $purchases[$analysis->general_name] = ['price' => $analysis->price, 'code' => $analysis->code, 'discount' => $analysis->discount];
                }
                foreach ($packages as $package) {
                    $price += $package->price;
                    $purchases[$package->name] = ['price' => $package->price, 'code' => '-', 'discount' => 0];
                }
        }

        if(request()->home_visit_fees == 'on'){
            $price += setting('home_visit_fees');
            $purchases['Home Visit Fees'] = [
                'price' => setting('home_visit_fees'),
                'code' => '-',
                'discount' => 0
            ];
        }

        $tax = $this->getTax(request(), $price);
        $price += $tax;
        $discount = $this->calculateDiscount($price, $responseArray);
        $price -= $discount;

        if(request()->ajax()){
            $responseArray['total_price'] = $price;
            return $responseArray;
        }else{
            $this->updateInvoice($price, $discount, $tax, $purchases);
            return $this;
        }

    }

    public function getTax($totalPrice)
    {
        $tax = 0;
        $nationalityLabel = Patient::find(request()->patient_id)->nationality_label;


        if(setting('tax_include') == config('enums.taxInclude.all')){

            $tax = $totalPrice * (setting('tax')/100);
        }elseif (setting('tax_include') == config('enums.taxInclude.saudi')){

            /** check if patient is saudi **/
            if ($nationalityLabel == 'sa'){
                $tax = $totalPrice * (setting('tax')/100);
            }

        }elseif (setting('tax_include') == config('enums.taxInclude.not_saudi')){
            /** check if patient is not saudi **/
            if ($nationalityLabel != 'sa'){
                $tax = $totalPrice * (setting('tax')/100);
            }
        }


        return $tax;
    }

    public function calculateDiscount($totalPrice, &$responseArray)
    {
        $discount = 0;
        if(request()->transfer == config('enums.transfer.contract'))
            $discount = (Category::find(request()->category_id)->percentage / 100) * $totalPrice;

        elseif(request()->transfer == config('enums.transfer.sector'))
            $discount = (Sector::find(request()->sector_id)->percentage / 100) * $totalPrice;

        $discount += $this->discountFromOffers($totalPrice, $responseArray);

        $discount += request()->discount;
        return $discount;
    }

    public function discountFromOffers($totalPrice, &$responseArray)
    {
        $discount = 0;
        $patient = Patient::find(request()->patient_id);

        $discount = $patient->calculateLoyaltyDiscount($totalPrice);

        // total price discount

        if($this->isInvoiceDiscountApplicable($totalPrice)){
            $discount += setting('invoice_discount_value');
            $responseArray['has_invoice_discount'] = setting('invoice_discount_value') > 0;
            $responseArray['discount'] = setting('invoice_discount_value');
            $responseArray['maximum_reach_value'] = setting('invoice_value');
        }

        // promo code discount
        if(request()->promo_code == 1) {
            $promoCode = PromoCode::find(request()->code_id);
            $promoCode->applyPromoCode($discount, $totalPrice);   
        }

        $responseArray['total_price'] = $totalPrice;
        return $discount;
    }

    public function isInvoiceDiscountApplicable($totalPrice)
    {
        return $totalPrice >= setting('invoice_value') && in_array(setting('invoice_discount_include'), [config('enums.transfer.all') ,request()->transfer]);
    }

    public function updateInvoice($price, $discount, $tax, $purchases)
    {
        $this->deleteUnselectedWaitingLabs();

        return $this->update([
            'patient_id'    => request()->patient_id,
            'doctor_id'     => request()->doctor_id,
            'hospital_id'   => request()->hospital_id,
            'transfer'      => request()->transfer,
            'company_id'    => request()->company_id,
            'category_id'   => request()->category_id,
            'promo_code_id' => request()->code_id ?? null,
            'policy_no'     => request()->policy_no,
            'purchases'     => serialize($purchases),
            'tax'           => $tax,
            'status'        => 1,
            'main_analysis' => serialize(request()->main_analysis_id),
            'packages'      => serialize(request()->package_id),
            'total_price'   => $price,
            'discount'      => $discount,
            'pay_method'    => request()->pay_method,
            'amount_paid'   => request()->amount_paid,
        ]);
    }

    public function generateWaitingLabs(Invoice $invoice)
    {
        $mainAnalysis = MainAnalysis::whereIn('id', unserialize($invoice->main_analysis) ?? [])->get();
        $mainAnalysisFromPackages = Package::whereIn('id', unserialize($invoice->packages) ?? [])->get()->map(function($package){
            return MainAnalysis::whereIn('id', unserialize($package->main_analysis))->get();
        })->flatten();


        $countWaitingLabsBeforeGeneration = WaitingLab::count();

        foreach ($mainAnalysis as $analysis) {
            WaitingLab::updateOrCreate([
                'patient_id' => $invoice->patient->id,
                'main_analysis_id' => $analysis->id,
                'invoice_id'=> $invoice->id
            ]);
        }
        foreach ($mainAnalysisFromPackages as $analysis) {
            WaitingLab::updateOrCreate([
                'patient_id' => $invoice->patient->id,
                'main_analysis_id' => $analysis->id,
                'invoice_id'=> $invoice->id
            ]);
        }

        $countWaitingLabsAfterGeneration = WaitingLab::count();

        if ($countWaitingLabsAfterGeneration > $countWaitingLabsBeforeGeneration) {
            Employee::first()->notify(new WaitingLabNotification());
            pushNotification();
        }

    }

    public function deleteUnselectedWaitingLabs()
    {
        $unselectedAnalysesIds = Package::whereIn('id', unserialize($this->packages) ?? [])->pluck('id')->diff(request()->package_id);
        $unselectedAnalyses = MainAnalysis::whereIn('id', unserialize($this->main_analysis) ?? [])->pluck('id')->diff(request()->main_analysis_id);
        
        $this->waiting_labs()->whereIn('main_analysis_id', $unselectedAnalyses->toArray())->delete();
        Package::whereIn('id', $unselectedAnalysesIds)->get()->map(function($package){
            $this->waiting_labs()->whereIn('main_analysis_id', unserialize($package->main_analysis) ?? [])->delete();
        });
    }

    public function assignTransfer(Request $request, $price)
    {
        if ($request->transfer == config('enums.transfer.doctor'))
        {
            $doctor = Doctor::find($request->doctor_id);
            $doctor->updateWallet($price);
        }elseif($request->transfer == config('enums.transfer.hospital')){
            $hospital = Hospital::find($request->hospital_id);
            $hospital->updateDuesAmount($price);

        }elseif($request->transfer == config('enums.transfer.contract')){
            $company = Company::find($request->company_id);
            $company->updateDues($price);
        }
    }

}

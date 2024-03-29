<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
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



}

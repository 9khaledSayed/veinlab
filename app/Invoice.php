<?php

namespace App;

use App\HR\Branch;
use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
        'approved_date'  => 'date',
    ];

    public static function booted()
    {
        static::addGlobalScope(new BranchScope());
        
        static::creating(function ($model){
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

        static::creating(function($invoice){
            $invoice->branch_id = request()->branch_id ?? setting('current_branch');
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

    public function branch()
    {
        return $this->belongsTo(Branch::class);
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

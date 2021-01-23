<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revenue extends Model
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
            $last_revenue = Revenue::get()->last();
            $last_serial_no = $last_revenue->serial_no ?? null;
            if($last_serial_no){
                $serial_without_year = substr($last_serial_no, 4);
            }
            $model->employee_id   = auth()->user()->id;
            $model->serial_no     = isset($last_serial_no) ? date("Y") . ++$serial_without_year : date("Y") . '11111' . '10000';
        });
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

}

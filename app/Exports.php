<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exports extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
        'checkDate'  => 'date:D M d Y',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function lastSerialNo()
    {
        $last_serial = Exports::get()->last()->serial_no ?? null;
        return isset($last_serial)? ++$last_serial : date("Y") . '11111' . '10000';
    }
}

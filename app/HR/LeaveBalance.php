<?php

namespace App\HR;

use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    protected $guarded = [];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function vacation_type()
    {
        return $this->belongsTo(VacationType::class,'vacation_id');
    }

}

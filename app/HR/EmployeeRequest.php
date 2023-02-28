<?php

namespace App\HR;

use App\HR\VacationType;
use Illuminate\Database\Eloquent\Model;

class EmployeeRequest extends Model
{
    protected $table = "employee_requests";

    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];

    public function employee()
    {
        return $this->belongsTo(\App\Employee::class,'employee_id')->withTrashed();
    }

    public function vacation_type()
    {
        return $this->belongsTo(VacationType::class,'vacation_id');
    }



}

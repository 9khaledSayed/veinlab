<?php

namespace App\HR;

use App\HR\SalaryReport;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $guarded =[];
    protected $dates = ['date', 'issue_date'];

    public function employee()
    {
        return $this->belongsTo(\App\Employee::class)->withTrashed();
    }

    public function salary_report()
    {
        return $this->belongsTo(SalaryReport::class);
    }
}





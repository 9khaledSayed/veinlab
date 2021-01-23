<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $guarded =[];
    protected $dates = ['date', 'issue_date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function salary_report()
    {
        return $this->belongsTo(SalaryReport::class);
    }
}





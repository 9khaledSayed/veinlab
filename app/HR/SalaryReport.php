<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryReport extends Model
{
    protected $guarded=[];
    protected $dates = ['date', 'issue_date'];
    protected $casts = [
        'date'  => 'date:M-Y',
    ];
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}

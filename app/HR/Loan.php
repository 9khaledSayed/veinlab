<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = "additions_deductions_loans";
    protected $guarded=[];
    protected $dates = [
        'created_at'  => 'date:Y-m-d h:iA',
        'updated_at'  => 'date:Y-m-d h:iA',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

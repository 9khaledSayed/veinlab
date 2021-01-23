<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $table = "additions_deductions_loans";
    protected $dates = ['effective_date'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at'  => 'date:Y-m-d',
        'effective_date'  => 'date:Y-m',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

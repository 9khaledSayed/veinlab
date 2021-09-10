<?php

namespace App\HR;

use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    protected $table = "additions_deductions_loans";
    protected $guarded = [];
    protected $dates = ['effective_date'];
    protected $casts = [
        'created_at'  => 'date:Y-m-d h:iA',
        'updated_at'  => 'date:Y-m-d h:iA',
        'effective_date'  => 'date:Y-m',
    ];
    public function employee()
    {
        return $this->belongsTo(\App\Employee::class)->withTrashed();
    }
}

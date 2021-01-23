<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];
//    protected $dates = ['time_in', 'time_out'];
    protected $casts = [
        'created_at'  => 'date:d-m-Y',
//        'time_in'     => 'date:h:iA',
//        'time_out'     => 'date:h:iA',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

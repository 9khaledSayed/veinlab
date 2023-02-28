<?php

namespace App\HR;



class Decision extends Base
{
//    protected $dates = ['from_date', 'to_date'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
        'updated_at'  => 'date:D M d Y',
        'from_date'  => 'date:Y-m',
        'to_date'  => 'date:Y-m',
    ];

    public function employee()
    {
        return $this->belongsTo(\App\Employee::class)->withTrashed();
    }
    public static function boot()
    {
        parent::boot();
    }
}

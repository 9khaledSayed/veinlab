<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $guarded = [];
    protected $dates = ['from_date','to_date'];
    protected $casts = [
        'from_date' => 'date: Y-m-d',
        'to_date' => 'date: Y-m-d'
    ];
}

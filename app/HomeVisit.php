<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeVisit extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
}
//2020-08-28T20:10

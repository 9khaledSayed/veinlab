<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $fillable = ['name','phone','email','percentage'];
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
    ];
}

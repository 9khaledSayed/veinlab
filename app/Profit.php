<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profit extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $fillable = ['value'];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
}

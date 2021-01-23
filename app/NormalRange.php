<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NormalRange extends Model
{

    protected $dates = ['deleted_at'];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
}

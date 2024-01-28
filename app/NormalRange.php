<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NormalRange extends Model
{


    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
    protected $table = 'normal_ranges';
    protected $guarded = [];
}

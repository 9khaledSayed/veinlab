<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryType extends Model
{
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
}

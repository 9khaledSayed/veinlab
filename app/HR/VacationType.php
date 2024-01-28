<?php

namespace App\HR;

use Illuminate\Database\Eloquent\Model;

class VacationType extends Model
{
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
}

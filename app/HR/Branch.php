<?php

namespace App\HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
}

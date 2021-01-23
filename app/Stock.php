<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $fillable = ['item','quantity', 'total_price','company_name'];
    protected $casts = [
        'created_at' => 'date:Y-m-d'
    ];
}

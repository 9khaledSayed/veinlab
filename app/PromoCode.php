<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
        'from'        => 'date:Y-m-d',
        'to'        => 'date:Y-m-d',
    ];

    public function main_analysis()
    {
        return $this->belongsTo(MainAnalysis::class)->withTrashed();
    }
}

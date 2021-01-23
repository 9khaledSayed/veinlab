<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{

    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
    public function sub_analysis()
    {
        return $this->belongsTo(SubAnalysis::class);
    }
    public function main_analysis()
    {
        return $this->belongsTo(MainAnalysis::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaitingLab extends Model
{
    use SoftDeletes;


//    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $dates = [
        'created_at'  => 'date:Y-m-d h:iA',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function main_analysis()
    {
        return $this->belongsTo(MainAnalysis::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);

    }

    public function invoice (){
        return $this->belongsTo(Invoice::class);
    }

    public function notes (){
        return $this->hasOne(Notes::class);
    }


}

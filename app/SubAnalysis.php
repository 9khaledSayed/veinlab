<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubAnalysis extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at', 'created_at'];
    protected $fillable = ['name','unit','main_analysis_id'];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
    public function main_analysis()
    {
        return $this->belongsTo(MainAnalysis::class,'main_analysis_id');
    }
    public function normal_ranges()
    {
        return $this->hasMany(NormalRange::class);
    }
}

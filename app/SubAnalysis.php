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
        return $this->belongsTo(MainAnalysis::class,'main_analysis_id')->withTrashed();
    }
    public function normal_ranges()
    {
        return $this->hasMany(NormalRange::class);
    }

    public function spans($gender)
    {
        if(!isset($this->unit) && $this->normal($gender) == null){
            return 3;
        }elseif(!isset($this->unit) || !$this->normal($gender)){
            return 2;
        }else{
            return 1;
        }
    }

    public function normal($gender)
    {
        $normalRanges = $this->normal_ranges;
        if($normalRanges->count() > 0){
            $normal = $normalRanges->whereIn('gender', [$gender, 3])->first();
            return $normal ? $normal->value: '';
        }else{
            return null;
        }

    }

    public function getUnitAttribute()
    {
        $unit = $this->attributes['unit'];
        $power = "";
        if (strpos($unit, '^') != false){
            $parts = explode('^', $unit);
            $numbersAfterCarrot = array_filter(preg_split("/\D+/", $parts[1]));

            if (count($numbersAfterCarrot) > 0){
                $power = $numbersAfterCarrot[0];
            }

            $prefix = $parts[0];
            $suffix = str_replace($power, "", $parts[1]);

            return "<span>$prefix<sup>$power</sup>$suffix</span>";
        }

        return $unit;
    }
}

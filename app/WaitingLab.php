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
        return $this->belongsTo(Patient::class)->withTrashed();
    }

    public function main_analysis()
    {
        return $this->belongsTo(MainAnalysis::class)->withTrashed();
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

    public function setHighSensitiveToAttribute($value)
    {
        if (isset($value)){
            $this->attributes['high_sensitive_to'] = serialize($value);
        }
    }
    public function setModerateSensitiveToAttribute($value)
    {
        if (isset($value)){
            $this->attributes['moderate_sensitive_to'] = serialize($value);
        }
    }
    public function setResistantToAttribute($value)
    {
        if (isset($value)){
            $this->attributes['resistant_to'] = serialize($value);
        }
    }

    public function getHighSensitiveToAttribute()
    {
        if (isset($this->attributes['high_sensitive_to'])){
            return unserialize($this->attributes['high_sensitive_to']);
        }
        return [];
    }
    public function getModerateSensitiveToAttribute($value)
    {
        if (isset($this->attributes['moderate_sensitive_to'])){
            return unserialize($this->attributes['moderate_sensitive_to']);
        }
        return [];
    }
    public function getResistantToAttribute($value)
    {
        if (isset($this->attributes['resistant_to'])){
            return unserialize($this->attributes['resistant_to']);
        }
        return [];
    }


}

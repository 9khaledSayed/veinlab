<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainAnalysis extends Model
{
    use SoftDeletes;

    public static $rules = [
        'general_name' => ['required', 'string', 'max:200'],
        'abbreviated_name' => ['required', 'string', 'max:100'],
        'code' => 'required|string|max:255|sometimes|unique:main_analyses',
        'cost' => ['required', 'min:0'],
        'discount' => ['required', 'min:0'],
        'price' => ['required', 'min:0'],
        'price_insurance' => ['required', 'min:0'],
        'price_hospital' => ['required', 'min:0']
    ];

    protected $dates = ['deleted_at'];
    protected $casts = [
        'created_at' => 'date:Y-m',
    ];

    public function sub_analysis()
    {
        return $this->hasMany(SubAnalysis::class);
    }

    protected $guarded = [];

}

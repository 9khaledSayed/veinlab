<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $fillable = ['name'];
    protected $casts = [
        'created_at'  => 'date:Y-m',
    ];
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}

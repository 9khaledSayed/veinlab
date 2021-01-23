<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $fillable = ['name','company_id'];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
}

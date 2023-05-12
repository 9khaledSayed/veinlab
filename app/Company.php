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

    public function updateDues($price)
    {
        $company_discount = (Category::find(request()->category_id)->percentage / 100) * $price;
        $this->our_money += $company_discount;
        $this->save();
    }
}

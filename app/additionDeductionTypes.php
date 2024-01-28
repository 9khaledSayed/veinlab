<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class additionDeductionTypes extends Model
{
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];

    public function name()
    {
        return (App::isLocale('ar'))?$this->name_ar:$this->name_en;
    }
}

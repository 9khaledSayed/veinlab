<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllowanceType extends Model
{
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

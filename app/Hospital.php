<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Hospital extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
    ];
    protected $guard = 'hospital';

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => 'required|string|email|max:255|sometimes|unique:employees',
        'amount' => ['required', 'numeric', 'min:0'],
        'amount_type' => ['required', 'in:addition,deduction', 'min:0'],
        'phone' => ['required'],
        'password' => ['required' ,'min:8', 'confirmed'],
    ];
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

}

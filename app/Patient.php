<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $guard = 'patient';
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public static $rules = [
        'password' => ['required', 'string', 'min:8'],
        "name" => ['required', 'string', 'max:255'],
        "name_in_english" => ['nullable', 'string', 'max:255'],
        "email" => 'nullable|string|email:dns|max:255|unique:patients',
        "phone" => 'required|digits:',
        "id_no" => 'required|sometimes|unique:patients',
        "gender" => ['required'],
        "age" => ['required'],
        "city" => ['nullable', 'string', 'max:255'],
        "address" => ['nullable', 'string', 'max:255'],
        "diseases" => ['nullable', 'string', 'max:255'],
        "blood_type" => ['nullable', 'string', 'max:255'],
        "weight" => ['nullable', 'string', 'max:255'],
        "height" => ['nullable', 'string', 'max:255'],
        "nationality_id" => ['required', 'numeric']
    ];

    public function hospital (){

        return $this->belongsTo(Hospital::class);

    }
    public function doctor (){

        return $this->belongsTo(Doctor::class);

    }

    public function routeNotificationForNexmo($notification)
    {
        return $this->phone;
    }

}

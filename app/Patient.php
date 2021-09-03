<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Http;

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
        "phone" => 'required',
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


    public function getGenderNameAttribute()
    {
        switch ($this->gender){
            case 0:
                return 'Male';
            case 1:
                return 'Female';
            case 2:
                return 'Child';
        }
    }

    public function getNationalityLabelAttribute()
    {
        return Nationality::withTrashed()->find($this->nationality_id)->label;
    }


    public function sendWhatsappMessage($message)
    {
        $phone = 201024098963;
        $response = Http::get("https://hiwhats.com/API/send" , [
            'mobile' => env('HIWHATSAPP_SENDER_MOBILE'),
            'password' => env('HIWHATSAPP_SENDER_PASSWORD'),
            'instanceid' => env('HIWHATSAPP_INSTANCE_ID'),
            'message' => $message,
            'numbers' => $phone,
            'json' => 1,
            'type' => 1,
        ]);

        return $response;
    }

    public function sendWhatsappFile($fileUrl)
    {
        /**check if there is a pdf for this invoice then return file url**/

        /**else then generate a pdf and store it the get the file url**/

    }


}

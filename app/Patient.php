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
    protected $appends = ['full_phone'];
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

    public function setPhoneAttribute($value) {
        $this->attributes['phone'] = '966' . intval($value);
    }

    public function getPhoneAttribute() {
        return '0' . substr($this->attributes['phone'], 3);
    }

    public function getFullPhoneAttribute() {
        return '966' . substr($this->attributes['phone'], 3);
    }


    public function sendWhatsappMessage($message)
    {

        $response = Http::get("https://hiwhats.com/API/send" , [
            'mobile' => env('HIWHATSAPP_SENDER_MOBILE'),
            'password' => env('HIWHATSAPP_SENDER_PASSWORD'),
            'instanceid' => env('HIWHATSAPP_INSTANCE_ID'),
            'message' => $message,
            'numbers' => $this->full_phone,
            'json' => 1,
            'type' => 1,
        ]);

        return \GuzzleHttp\json_decode($response->body());
    }

    public function sendWhatsappFile($fileUrl)
    {

        $phone = 201024098963;
        $response = Http::get("https://hiwhats.com/API/send" , [
            'mobile' => env('HIWHATSAPP_SENDER_MOBILE'),
            'password' => env('HIWHATSAPP_SENDER_PASSWORD'),
            'instanceid' => env('HIWHATSAPP_INSTANCE_ID'),
            'message' => 'test',
            'numbers' => $this->full_phone,
            'json' => 1,
            'fileurl' => $fileUrl,
            'type' => 2,
        ]);

        return \GuzzleHttp\json_decode($response->body());
    }
    

    public function calculateLoyaltyDiscount($totalPrice)
    {
        if($this->isLoyaltyDiscountApplicable()){
            $loyaltyDiscPercentage = setting('loyalty_discount_value');
            return $totalPrice * ($loyaltyDiscPercentage/100);
        }

        return 0;
    }

    public function isLoyaltyDiscountApplicable()
    {
        return $this->visit_no >= setting('no_visits') && in_array(setting('loyalty_discount_include'), [config('enums.transfer.all'), request()->transfer]);
    }

}

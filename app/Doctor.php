<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $fillable = ['name','phone','email','percentage'];
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
    ];

    public function updateWallet($totalPrice)
    {
        $doctorMoney  = $totalPrice * ($this->percentage / 100 );
        $this->update([
            'wallet' => $this->wallet += $doctorMoney,
            'longtime_wallet' => $this->lifetime_wallet += $doctorMoney,
            'no_patients' => $this->no_patients += 1
        ]);
    }
}

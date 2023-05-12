<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
        'from'        => 'date:Y-m-d',
        'to'        => 'date:Y-m-d',
    ];

    public function main_analysis()
    {
        return $this->belongsTo(MainAnalysis::class)->withTrashed();
    }

    public function applyPromoCode(&$discount, $totalPrice)
    {
        if($this->type == config('enums.promoCodeOn.invoice')){   // promo code on the invoice
            $discount += $totalPrice * ($this->percentage / 100);
        }else if ($this->type == config('enums.promoCodeOn.analysis')){
            $promoCodeAnalysis = $this->main_analysis;
            $patientTransferIncluded = in_array($this->include, [config('enums.transfer.all'), request()->transfer]);

            if(in_array($promoCodeAnalysis->id, request()->main_analysis_id) && $patientTransferIncluded){
                $discount += floatval($promoCodeAnalysis->price * ($this->percentage/100));
            }
        }
    }
}

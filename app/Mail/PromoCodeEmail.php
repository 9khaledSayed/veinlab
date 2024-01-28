<?php

namespace App\Mail;

use App\MainAnalysis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromoCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $percentage;
    public $analysis;
    public $patient_name;
    public $start;
    public $end;

    public function __construct($code, $percentage, $analysis, $patient_name, $start, $end)
    {

        $this->code = $code;
        $this->percentage = $percentage;
        $this->patient_name = $patient_name;
        $this->start = $start;
        $this->end = $end;
        if (isset($analysis)){
            $this->analysis = $analysis;
        }
    }


    public function build()
    {
        return $this->view('emails.promo-code');
    }
}

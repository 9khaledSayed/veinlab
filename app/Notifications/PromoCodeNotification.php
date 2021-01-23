<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PromoCodeNotification extends Notification
{
    use Queueable;

    public $code;
    public $percentage;
    public $analysis;
    public $patient_name;
    public $start;
    public $end;
    public $request;
    public $channels;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $request, $code, $percentage, $analysis, $patient_name, $start, $end)
    {
        $this->id = $request->id;
        $this->channels = array_values($request->notify);
        $this->request = $request;
        $this->code = $code;
        $this->percentage = $percentage;
        $this->patient_name = $patient_name;
        $this->start = $start;
        $this->end = $end;
        if (isset($analysis)){
            $this->analysis = $analysis;
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $viewData=  [
            'code' => $this->code,
            'percentage' => $this->percentage,
            'analysis' => $this->analysis,
            'patient_name' => $this->patient_name,
            'start' => $this->start,
            'end' => $this->end,
        ];

        return (new MailMessage)
            ->view('emails.promo-code',$viewData);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'url' => '/promo_codes/' . $this->code,
            'code' => $this->code,
            'percentage' => $this->percentage,
            'analysis' => $this->analysis,
            'patient_name' => $this->patient_name,
            'start' => $this->start,
            'end' => $this->end,
            'message' => "لـقـد حصلـت عـلي برومو كـود جـديـد"
        ];
    }
}

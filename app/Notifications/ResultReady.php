<?php

namespace App\Notifications;

use App\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class ResultReady extends Notification
{
    use Queueable;

    public $analysis_url;
    public $email;
    public $patient_name ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($analysis_url ,Patient $patient)
    {
        $this->analysis_url = $analysis_url;
        $this->email = $patient->email;
        $this->patient_name  = $patient->name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
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
            'patient_name' => $this->patient_name,
            'analysis_url' => $this->analysis_url
        ];

        return (new MailMessage)
               ->view('emails.result',$viewData);
    }


    public function toArray($notifiable)
    {
        return [
            'url' =>$this->analysis_url,
            'message' =>'لقد تم الأنتهاء من نتائج التحليل الخاص بك',
        ];
    }
}

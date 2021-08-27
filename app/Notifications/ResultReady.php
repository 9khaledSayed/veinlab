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
    public $title;
    public $date;
    public $icon;
    public $class;
    public $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Patient $patient, $invoiceId)
    {
        $this->analysis_url = route('dashboard.results.show', $invoiceId);
        $this->email = $patient->email;
        $this->patient_name  = $patient->name;

        $this->title = "لقد تم الأنتهاء من نتائج التحليل الخاص بك";
        $this->icon = 'fas fa-file-invoice';
        $this->class = 'success';
        $this->url = route('dashboard.results.show', $invoiceId);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'title' => $this->title,
            'date' => $this->date,
            'icon' => $this->icon,
            'class' => $this->class,
            'url' => $this->url,
        ];
    }
}

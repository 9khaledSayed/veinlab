<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $title;
    public $date;
    public $icon;
    public $class;
    public $url;

    public function __construct()
    {
        $this->title = "يوجد طلب من موظف ينتظر اجراء";
        $this->icon = 'flaticon2-layers';
        $this->class = 'success';
        $this->url = route('dashboard.hr.requests.pending');
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

//        return (new MailMessage)
//            ->view('emails.request');
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
            'title' => $this->title,
            'date' => $this->date,
            'icon' => $this->icon,
            'class' => $this->class,
            'url' => $this->url,
        ];
    }
}

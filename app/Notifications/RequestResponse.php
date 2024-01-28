<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestResponse extends Notification
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

    public function __construct($title)
    {
        $this->title = $title;
        $this->icon = 'flaticon2-website';
        $this->class = 'warning';
        $this->url = "/dashboard/hr/requests/mine";
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
            'response' => $this->title
        ];
        return (new MailMessage)
            ->view($viewData, 'emails.request');
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

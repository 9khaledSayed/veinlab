<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HomeVisitNotification extends Notification
{
    use Queueable;

    public $title;
    public $date;
    public $icon;
    public $class;
    public $url;

    public function __construct($homeVisitId)
    {
        $this->title = "هناك طلب زيارة منزلية";
        $this->icon = 'flaticon2-protection';
        $this->class = 'success';
        $this->url = route('dashboard.home_visits.show', $homeVisitId);
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
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

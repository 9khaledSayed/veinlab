<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemoNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $message;
    public $memo_no;
    public $title;
    public $text;

    public function __construct($message,$memo_no,$title,$text)
    {
        $this->message = $message;
        $this->memo_no = $memo_no;
        $this->title   = $title;
        $this->text    = $text;
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
            'title' => $this->title,
            'text' => $this->text
        ];

        return (new MailMessage)
            ->view('emails.memo',$viewData);
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
            "url" =>'/dashboard/hr/memos/mine',
            "message" => $this->message,
            "memo" => $this->memo_no
        ];
    }
}

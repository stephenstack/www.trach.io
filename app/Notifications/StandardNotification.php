<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use \Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;

class StandardNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;
    protected $subject;

    public function __construct($message, $subject)
    {
        $this->message = $message;
        $this->subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->subject($this->subject)
                    ->line(new HtmlString('<p>'.$this->message.'</p>'))
                    ->action('Login to view', url('/login'))
                    ->line('Regards!');
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
            //
        ];
    }
}

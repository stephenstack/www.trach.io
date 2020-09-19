<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use \Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;

class InviteeNotificiation extends Notification
{
    use Queueable;


    public function __construct($message, $subject, $tenant_id)
    {
        $this->message = $message;
        $this->subject = $subject;
        $this->tenant_id = $tenant_id;
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
                    ->action('Register', url('/invitee/' . $this->tenant_id))
                    ->line('Thanks for using trach.io - caring everday!');
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

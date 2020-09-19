<?php

namespace App\Notifications;

use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMailingListSubscriberVerification extends Notification
{
    use Queueable;

    protected $input;


    public function __construct($input)
    {
        $this->input = $input;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        try {
            return (new MailMessage)
                        ->subject('trach.io - Verify Email Address')
                        ->greeting('Hello!')
                        ->line('Please click the button below to verify your email address for the trach.io mailing list.')
                        ->action('Verify Email Address', url("/mailing-list-subscriber-verification/".$this->input['id']))
                        ->line('If you did not create sign up for our mailing list, no further action is required!');

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

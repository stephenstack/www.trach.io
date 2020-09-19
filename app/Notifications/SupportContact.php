<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use \Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;

class SupportContact extends Notification implements ShouldQueue
{
    use Queueable;

    protected $data;
    protected $sendingUser;


    public function __construct($data)
    {
        $this->data = $data;
        $this->sendingUser = $data['sendingUser'][0];
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {

        try {
            return (new MailMessage)
                        ->subject('Trachy Log - Support Contact Notification')
                        ->greeting('Subject: ' . $this->data['subject'])
                        ->line('Hello Admin,')
                        ->line('The support contact form was sent by ' . $this->sendingUser['name'])
                        ->line(new HtmlString('<strong>tenant_id: </strong>' . $this->data['tenant_id']))
                        ->action('Reply to user', url('mailto:'.$this->sendingUser['email'] .'?subject=re: ' . $this->data['subject']))
                        ->line(new HtmlString('<strong>Message: </strong>'))
                        ->line( $this->data['message'])
                        ->line('Thank you for using trach.io!');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

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

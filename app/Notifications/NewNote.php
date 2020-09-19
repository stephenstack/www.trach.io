<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use \Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;

class NewNote extends Notification implements ShouldQueue
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

        return (new MailMessage)
                    ->subject('Trachy Log - A new "'.$this->input['data']['data'][0]['category']['name'].'" note was added')
                    ->greeting('Note Title: ' . $this->input['data']['data'][0]['title'])
                    ->line('Hello Admins,')
                    ->line('A new note was added by ' . $this->input['data']['data'][0]['owner_name'])
                    ->line(new HtmlString('<strong>Note category is: </strong>' . $this->input['data']['data'][0]['category']['name']))
                    ->line(new HtmlString('<strong>Tenant_id: </strong>' . $this->input['tenant_id']))
                    ->action('Click here to view note', url('/notes'))
                    ->line(new HtmlString('<strong>Note content: </strong>'))
                    ->line( $this->input['data']['data'][0]['note'])
                    ->line('Thank you for using trach.io!');


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

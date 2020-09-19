<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTenantUserAdded extends Notification
{
    use Queueable;

    protected $newuser;
    public function __construct($newuser)
    {
        $this->newuser = $newuser;
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

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'user added',
            'user_name' => $this->newuser->name,
            'user_email' => $this->newuser->email,
            //'message' => "Hi there, a new ticket <a routerLink=\"/tickets/{$this->ticket->id}\">#{$this->ticket->reference_no}</a> has been created",
            'message' => "A new user was added recently.",
        ];
    }

}

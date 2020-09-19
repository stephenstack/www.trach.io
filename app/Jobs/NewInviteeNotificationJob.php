<?php

namespace App\Jobs;

use App\Notifications\InviteeNotificiation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewInviteeNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $detail;
    protected $subject;
    protected $message;

    public function __construct($detail, $subject)
    {
        $this->detail = $detail;
        $this->subject = $subject;

    }

    public function handle()
    {

        $this->message = ' Your friend '.$this->detail['sender_email'].', has invited you to trach.io. Please register by clicking the link below and completing the form.
        Trach.io is an app that assists in the care of patients with traceostomys.';
        \Notification::route('mail', $this->detail['recipient_email'])->notify(new InviteeNotificiation($this->message, $this->subject, $this->detail['tenant_id']));
    }
}

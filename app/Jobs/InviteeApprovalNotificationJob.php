<?php

namespace App\Jobs;

use App\Notifications\InviteeApprovalNotificiation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InviteeApprovalNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $subject;
    protected $message;

    public function __construct($user, $subject)
    {
        $this->user = $user;
        $this->subject = $subject;

    }

    public function handle()
    {
        $this->message = 'You were approved to login and use trach.io by. Please click the link below.
        Trach.io is an app that assists in the care of patients with traceostomys.';
        \Notification::route('mail', $this->user[0]->email)->notify(new InviteeApprovalNotificiation($this->message, "Your access to trach.io is approved!"));
    }
}

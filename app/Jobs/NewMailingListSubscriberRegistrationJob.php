<?php

namespace App\Jobs;

use App\Notifications\NewMailingListSubscriberVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewMailingListSubscriberRegistrationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipient;

    public function __construct(object $recipient)
    {

        $this->recipient = $recipient;
    }

    public function handle()
    {
        \Notification::route('mail', $this->recipient['email'])->notify(new NewMailingListSubscriberVerification($this->recipient));

    }
}

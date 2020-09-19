<?php

namespace App\Jobs;

use App\User;
use App\Notifications\NewInviteeSignupNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewInviteeSignupNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tenant_id;

    public function __construct($tenant_id)
    {
        $this->tenant_id = $tenant_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tenant_admins = User::where('tenant_id', $this->tenant_id)->where('role_id', 2)->get();
        foreach ($tenant_admins as $user) {
            $user->notify(new NewInviteeSignupNotification("A new user has requested access to trach.io"));
        }
    }
}

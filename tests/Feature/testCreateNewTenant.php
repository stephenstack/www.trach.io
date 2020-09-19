<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class testCreateNewTenant extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddTenantRecord()
    {
        $job = (new \App\Jobs\CreateNewTenantJob($data));

        dispatchNow($job);

        // $job = new \App\Jobs\YourJob;
        // $job->handle();

        // $job = Job::dispatchNow();



    }
}

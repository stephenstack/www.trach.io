<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardViewTest extends TestCase
{

    
    /** @test */
    public function testExample()
    {
        // NEED TO USE LARAVEL DUSK
        // https://laravel-news.com/testing-vue-components-with-laravel-dusk
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

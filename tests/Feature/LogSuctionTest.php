<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogSuctionTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_log_a_suction_event(){

        $this->withoutExceptionHandling();


        $attributes = [
            'owner_id' => $this->faker->randomDigit,
        ];


        // $this->post('api/suctions', $attributes)->assertStatus(201);
        $this->json('POST', 'api/suctions', $attributes)->assertStatus(201);

        $this->assertDatabaseHas('suctions', $attributes);

        // $this->get('api/suctions')->assertSee($attributes['owner_id'])->assertStatus(200);
        $this->json('GET', 'api/suctions', $attributes)->assertStatus(200);

    }

    /** @test */
    public function a_suction_requests_an_owner(Type $var = null)
    {
        $attributes = factory('App\Suction')->make(['owner_id' => NULL]);

        $this->post('/api/suctions', [])->assertSessionHasErrors('owner_id');
    }

}

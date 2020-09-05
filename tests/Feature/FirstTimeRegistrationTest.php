<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FirstTimeRegistrationTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Guess cannot access build your profile page without being authenticated.
     *
     * @return void
     */
    /** @test */
    public function test_Guess_Cannot_Access_Build_Your_Profile_Page()
    {

        $response = $this->get('/register/build-your-profile');

        $response->assertRedirect('/');
    }
}

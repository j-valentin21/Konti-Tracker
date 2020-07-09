<?php

namespace Tests\Feature;



use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Register a user.
     *
     * @return void
     */
    /** @test */
    public function a_user_can_register()
    {
        $user = factory(User::class)->create();

        $password = $user->password;

        $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $this->assertCount(1, User::all());
    }
}

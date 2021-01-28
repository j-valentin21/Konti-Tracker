<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;


    public function test_Register_Page_Can_Be_Viewed():void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_Registers_A_Valid_User():void
    {
        $user = factory(User::class)->make();

        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect('/register/build-your-profile');

        $this->assertAuthenticated();
    }

    public function test_Does_Not_Register_An_Invalid_User():void
    {
        $user = factory(User::class)->make();

        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'invalid'
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }
}

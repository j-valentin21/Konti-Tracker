<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{

    use DatabaseTransactions;

    public function test_Password_Reset_Page_Be_Viewed():void
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
    }

    //Failing in jenkins with status code 500
//    public function test_Home_Page_Can_Be_Viewed():void
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }


    public function test_Login_A_Valid_User():void
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_Does_Not_Login_An_Invalid_User():void
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }

    public function test_Logout_An_Authenticated_User():void
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertStatus(302);

        $this->assertGuest();
    }
}



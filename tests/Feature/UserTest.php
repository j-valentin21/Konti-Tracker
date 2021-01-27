<?php

namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * The password reset page can be viewed.
     *
     * @return void
     */
    public function test_Password_Reset_Page_Be_Viewed()
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
    }

    /**
     * The home page can be viewed.
     *
     * @return void
     */
    public function test_Home_Page_Can_Be_Viewed()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A valid user can be logged in.
     *
     * @return void
     */
    public function test_Login_A_Valid_User()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * An invalid user cannot be logged in.
     *
     * @return void
     */
    public function test_Does_Not_Login_An_Invalid_User()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }

    /**
     * A logged in user can be logged out.
     *
     * @return void
     */
    public function test_Logout_An_Authenticated_User()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertStatus(302);

        $this->assertGuest();
    }
}



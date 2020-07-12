<?php

namespace Tests\Feature;



use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * The user gets authenticated when logged in and redirected back to home route.
     *
     * @return void
     */
    /** @test */
    public function login_authenticates_and_redirects_user()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);

    }

    /** @test */
    public function register_creates_and_authenticates_a_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('home'));

    }
}



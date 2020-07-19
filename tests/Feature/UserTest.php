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
     * The user gets authenticated when logged in and redirected back to dashboard.
     *
     * @return void
     */
    /** @test */
    public function login_authenticates_and_redirects_user()
    {

       $response = $this->actingAs($user = factory(User::class)->create())
            ->post(route('login'), [
                'email' => $user->email ,
                'password' => $user->password
            ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);

    }

    /** @test */
    public function register_creates_and_authenticates_a_user()
    {

        $user = factory(User::class)->create();

        $response = $this->actingAs($user = factory(User::class)->create())
            ->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'dsfdfsd',
            'password_confirmation' => $user->password
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('home'));

    }
}



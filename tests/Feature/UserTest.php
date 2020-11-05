<?php

namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
    public function test_Login_Authenticates_And_Redirects_User_Dashboard()
    {

       $response = $this->actingAs($user = factory(User::class)->create())
            ->post(route('login'), [
                'email' => $user->email ,
                'password' => $user->password
            ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);

    }
    /**
     * Register and authenticate a user.
     *
     * @return void
     */
    /** @test */
    public function test_Register_Creates_And_Authenticates_A_User()
    {

        $response = $this->actingAs($user = factory(User::class)->create())
            ->post('/register');

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('dashboard.index'));

    }
    /**
     * User cannot view login form while authenticated.
     *
     * @return void
     */
    /** @test */
    public function test_User_Cannot_View_A_Login_Form_When_Authenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/dashboard');
    }

}



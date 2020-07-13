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

//    /** @test */
//    public function register_creates_and_authenticates_a_user()
//    {
//        $this->withoutExceptionHandling();
//
//        $user = factory(User::class)->create();
//
//        $response = $this->post('register', [
//            'name' => $user->name,
//            'email' => 'jack@gmail.com',
//            'password' => 'gjgosdfldsfds',
//            'password_confirmation' => 'gjgosdfldsfds'
//        ]);
//
//        $this->assertDatabaseHas('users', [
//            'name' => $user->name,
//            'email' => 'jack@gmail.com'
//        ]);
//        $this->assertAuthenticatedAs($user);
//        $response->assertRedirect(route('home'));
//
//    }
}



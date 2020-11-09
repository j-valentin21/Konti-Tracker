<?php

namespace Tests\Feature;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\FirstTimeUser;
use App\User;
use App\Profile;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class FirstTimeRegistrationTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Check if route to build your profile is working properly.
     *
     */
    public function test_Build_Your_Profile_View_Is_Working_Properly():void
    {
        $this->withoutMiddleware([FirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class,]);

        $response = $this->get('/register/build-your-profile');

        $response->assertStatus(200);
    }

    /**
     * Check if route to avatar is working properly.
     *
     */
    public function test_Avatar_View_Is_Working_Properly():void
    {
        $this->withoutMiddleware([FirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class]);

        $response = $this->get('/register/avatar');

        $response->assertStatus(200);
    }

    /**
     * Check if route to avatar is working properly.
     *
     */
    public function test_Confirmation_View_Is_Working_Properly():void
    {
        $this->withoutMiddleware([FirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class]);

        $response = $this->get('/register/confirmation');

        $response->assertStatus(200);
    }

    /**
     * Guest cannot access build your profile page without being authenticated.
     *
     */
    public function test_Guest_Cannot_Access_Build_Your_Profile_View():void
    {
        $response = $this->get('/register/build-your-profile');

        $response->assertRedirect('/');
    }

    /**
     * Guest cannot access avatar page without being authenticated.
     *
     */
    public function test_Guest_Cannot_Access_Avatar_Page():void
    {
        $response = $this->get('/register/avatar');

        $response->assertRedirect('/');
    }

    /**
     * Guest cannot access confirmation page without being authenticated.
     *
     */
    public function test_Guest_Cannot_Access_Confirmation_Page():void
    {
        $response = $this->get('/register/confirmation');

        $response->assertRedirect('/');
    }

    /**
     * Guest cannot access build your profile page without being authenticated and a first time user.
     *
     */

    public function test_Only_First_Time_User_Can_Access_Build_Your_Profile_Page():void
    {
        $this->actingAs($user = factory(User::class)->make());

        $this->assertEquals(
            Route::getRoutes()->getByName('profile')->gatherMiddleware(),
            ['web','auth','firstTimeUser','verified']
        );
        $this->assertEquals('1', $user->FirstTimeUser);
        $this->assertAuthenticatedAs($user);
    }

    public function test_Only_First_Time_User_Can_Access_Avatar_Page()
    {
        $this->actingAs($user = factory(User::class)->make());

        $this->assertEquals(
            Route::getRoutes()->getByName('avatar')->gatherMiddleware(),
            ['web','auth','firstTimeUser', 'verified']
        );
        $this->assertEquals('1', $user->FirstTimeUser);
        $this->assertAuthenticatedAs($user);
    }

    public function test_Only_First_Time_User_Can_Access_Confirmation_Page()
    {
        $this->actingAs($user = factory(User::class)->make());

        $this->assertEquals(
            Route::getRoutes()->getByName('confirmation')->gatherMiddleware(),
            ['web','auth','firstTimeUser', 'verified']
        );
        $this->assertEquals('1', $user->FirstTimeUser);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * User can post input in confirmation page.
     *
     */
    public function test_User_Can_Post_Input_On_Confirmation_Page():void
    {
        $user = factory(user::class)->create();
        $profile = factory(Profile::class)->create();

        $input = [
            'position' => $profile->position,
            'avatar' => $profile->avatar,
            'pto' => $profile->pto,
            'points' => $profile->points,
            'user_id' => $profile->user_id
        ];
        $response = $this->actingAs($user)
            ->post('/register/store', $input);

        $this->assertDatabaseHas('profiles', $input);
        $response->assertRedirect(route('dashboard.index'));
    }
}


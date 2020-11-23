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

    public function test_Build_Your_Profile_View_Is_Working_Properly():void
    {
        $this->withoutMiddleware([FirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class,]);

        $response = $this->get('/register/build-your-profile');

        $response->assertSuccessful();
    }

    public function test_Avatar_View_Is_Working_Properly():void
    {
        $this->withoutMiddleware([FirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class]);

        $response = $this->get('/register/avatar');

        $response->assertStatus(200);
    }

    public function test_Confirmation_View_Is_Working_Properly():void
    {
        $this->withoutMiddleware([FirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class]);

        $response = $this->get('/register/confirmation');

        $response->assertStatus(200);
    }

    public function test_Guest_Cannot_Access_Build_Your_Profile_View():void
    {
        $response = $this->get('/register/build-your-profile');

        $response->assertRedirect('/');
    }

    public function test_Guest_Cannot_Access_Avatar_Page():void
    {
        $response = $this->get('/register/avatar');

        $response->assertRedirect('/');
    }

    public function test_Guest_Cannot_Access_Confirmation_Page():void
    {
        $response = $this->get('/register/confirmation');

        $response->assertRedirect('/');
    }

    public function test_Only_First_Time_User_Can_Access_Build_Your_Profile_Page():void
    {
        $this->actingAs($user = factory(User::class)->make());

        $this->assertEquals(
            Route::getRoutes()->getByName('profile')->gatherMiddleware(),
            ['web','auth','firstTimeUser','verified']
        );
        $this->assertEquals('1', $user->firstTimeUser);
        $this->assertAuthenticatedAs($user);
    }

    public function test_Only_First_Time_User_Can_Access_Avatar_Page()
    {
        $this->actingAs($user = factory(User::class)->make());

        $this->assertEquals(
            Route::getRoutes()->getByName('avatar')->gatherMiddleware(),
            ['web','auth','firstTimeUser', 'verified']
        );
        $this->assertEquals('1', $user->firstTimeUser);
        $this->assertAuthenticatedAs($user);
    }

    public function test_Only_First_Time_User_Can_Access_Confirmation_Page()
    {
        $this->actingAs($user = factory(User::class)->make());

        $this->assertEquals(
            Route::getRoutes()->getByName('confirmation')->gatherMiddleware(),
            ['web','auth','firstTimeUser', 'verified']
        );
        $this->assertEquals('1', $user->firstTimeUser);
        $this->assertAuthenticatedAs($user);
    }
}


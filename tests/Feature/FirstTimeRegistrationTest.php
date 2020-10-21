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
     * @return void
     */
    public function test_Build_Your_Profile_Page_For_Status_Code_200()
    {
        $this->withoutMiddleware([FirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class,]);

        $response = $this->get('/register/build-your-profile');

        $response->assertStatus(200);
    }

    /**
     * Check if route to avatar is working properly.
     *
     * @return void
     */
    public function test_Avatar_For_Status_Code_200()
    {
        $this->withoutMiddleware([FirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class]);

        $response = $this->get('/register/avatar');

        $response->assertStatus(200);
    }

    /**
     * Check if route to avatar is working properly.
     *
     * @return void
     */
    public function test_Confirmation_For_Status_Code_200()
    {
        $this->withoutMiddleware([FirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class]);

        $response = $this->get('/register/confirmation');

        $response->assertStatus(200);
    }

    /**
     * Guest cannot access build your profile page without being authenticated.
     *
     * @return void
     */
    public function test_Guest_Cannot_Access_Build_Your_Profile_Page()
    {
        $response = $this->get('/register/build-your-profile');

        $response->assertRedirect('/');
    }

    /**
     * Guest cannot access avatar page without being authenticated.
     *
     * @return void
     */
    public function test_Guest_Cannot_Access_Avatar_Page()
    {
        $response = $this->get('/register/avatar');

        $response->assertRedirect('/');
    }

    /**
     * Guest cannot access confirmation page without being authenticated.
     *
     * @return void
     */
    public function test_Guest_Cannot_Access_Confirmation_Page()
    {
        $response = $this->get('/register/confirmation');

        $response->assertRedirect('/');
    }

    /**
     * Guest cannot access build your profile page without being authenticated and a first time user.
     *
     * @return void
     */

    public function test_Only_First_Time_User_Can_Access_Build_Your_Profile_Page()
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
     * User can pass session data to avatar page.
     *
     * @return void
     */
    public function test_User_Can_Pass_Sessions_To_Avatar_Page()
    {
        $this->withoutMiddleware([FirstTimeUser::class]);

        $profile = factory(Profile::class)->make();
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)
        ->withSession([
            'position' => $profile->position,
            'pto'=> $profile->pto,
            'points'=> $profile->points
        ])
            ->get('/register/avatar')
            ->assertSessionHasAll(['position', 'pto', 'points']);

        $response->assertStatus( 200);
    }

    /**
     * User can post input in confirmation page.
     *
     * @return void
     */
    public function test_User_Can_Post_Input_On_Confirmation_Page()
    {
        $user = factory(user::class)->create();
        $profile = factory(Profile::class)->create();

        $input = [
            'position' => $profile->position,
            'pto' => $profile->pto,
            'points' => $profile->points,
            'avatar' => $profile->avatar,
            'user_id' => $user->id
        ];
        $response = $this->actingAs($user)
            ->post('/register/store', $input);

        $this->assertDatabaseHas('profiles', $input);
        $response->assertRedirect(route('dashboard.index'));
    }
}


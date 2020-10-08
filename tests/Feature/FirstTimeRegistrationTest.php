<?php

namespace Tests\Feature;

use App\Http\Middleware\FirstTimeUser;
use App\User;
use App\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class FirstTimeRegistrationTest extends TestCase
{

    use RefreshDatabase;

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
     * Guest cannot access build your profile page without being authenticated.
     *
     * @return void
     */

    public function test_Only_First_Time_User_Can_Access_Build_Your_Profile_Page()
    {
        $this->actingAs($user = factory(User::class)->make());

        $this->assertEquals(
            Route::getRoutes()->getByName('profile')->gatherMiddleware(),
            ['web','auth','firstTimeUser']
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
        ])->get('/register/avatar');

        $response->assertSessionHasAll(['position', 'pto', 'points']);
        $response->assertStatus( 200);
    }
}


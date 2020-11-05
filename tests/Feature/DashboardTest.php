<?php

namespace Tests\Feature;

use App\Http\Middleware\NotFirstTimeUser;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guest cannot access dashboard without being authenticated.
     *
     */
    /** @test*/
    public function test_Guest_Cannot_Access_Dashboard():void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/');
    }

    /**
     * Guest cannot access dashboard as a FirstTimeUser authenticated.
     *
     */
    public function test_Only_Authenticated_Non_First_Time_User_Can_Access_Dashboard():void
    {
        $this->actingAs($user = factory(User::class)->make([
            'FirstTimeUser' => 0
        ]));

            $this->assertEquals(
                Route::getRoutes()->getByName('dashboard.index')->gatherMiddleware(),
                ['web','auth','NotFirstTimeUser', 'verified']
            );
            $this->assertEquals('0', $user->FirstTimeUser);
            $this->assertAuthenticatedAs($user);
    }

    /**
     * User can update data on the dashboard.
     *
     */
    public function test_User_Can_Update_Data_On_Dashboard():void
    {
        $user = factory(user::class)->create();
        $profile = factory(Profile::class)->create();

        $profile->pto = 3;
        $profile->points = 5;
        $months = $profile->pto_usage;
        $months[0] = 18;
        $profile->pto_usage = $months;

        $this->put(route('dashboard.update'),[$profile]);

        $this->assertEquals(3, $profile->pto);
        $this->assertEquals(5, $profile->points);
        $this->assertEquals(18, $profile->pto_usage[0]);
    }
}


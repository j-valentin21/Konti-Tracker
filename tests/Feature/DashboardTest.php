<?php

namespace Tests\Feature;

use App\Http\Middleware\NotFirstTimeUser;
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
     * @return void
     */
    /** @test*/
    public function test_Guest_Cannot_Access_Dashboard()
    {

        $response = $this->get('/dashboard');

        $response->assertRedirect('/');
    }

    /**
     * Guest cannot access dashboard as a FirstTimeUser authenticated.
     *
     * @return void
     */

    public function test_Only_Authenticated_Non_First_Time_User_Can_Access_Dashboard()
    {
        $this->actingAs($user = factory(User::class)->make([
            'FirstTimeUser' => 0
        ]));

            $this->assertEquals(
                Route::getRoutes()->getByName('dashboard.index')->gatherMiddleware(),
                ['web','auth','NotFirstTimeUser']
            );
            $this->assertEquals('0', $user->FirstTimeUser);
            $this->assertAuthenticatedAs($user);
    }

}

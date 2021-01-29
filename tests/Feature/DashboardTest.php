<?php

namespace Tests\Feature;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\NotFirstTimeUser;
use App\User;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use DatabaseTransactions;

    public function test_Build_Your_Profile_View_Is_Working_Properly():void
    {
        $this->withoutMiddleware([NotFirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class,]);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_Guest_Cannot_Access_Dashboard():void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/');
    }

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
}


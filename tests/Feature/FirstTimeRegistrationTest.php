<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
    /** @test */
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
    /** @test */
    public function test_Only_Authenticated_First_Time_User_Can_Access_Build_Your_Profile_Page()
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
     * User can post input to build-your profile page.
     *
     * @return void
     */
    /** @test */
    public function test_User_Can_Post_To_Build_Your_Profile_Page()
    {
        $profile = factory(Profile::class)->create()
            ->post(route('login'), [
                'position' => $profile->position ,
                'image' => $profile->image
            ]);

        $this->assertDatabaseHas('profile', [
            'position' => 'Material Handler',
            'image' => 'car.jpg',
        ]);


    }
}


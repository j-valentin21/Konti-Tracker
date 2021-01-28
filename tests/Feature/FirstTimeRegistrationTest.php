<?php

namespace Tests\Feature;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\FirstTimeUser;
use App\Profile;
use App\User;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
class FirstTimeRegistrationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_Build_Your_Profile_View_Is_Working_Properly():void
    {
        $this->withoutMiddleware([FirstTimeUser::class, Authenticate::class, EnsureEmailIsVerified::class,]);

        $response = $this->get('/register/build-your-profile');

        $response->assertSuccessful();
        $response->assertStatus(200);
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

    public function test_User_Can_Post_On_Build_Your_Profile_Page():void
    {
        $this->withoutMiddleware([FirstTimeUser::class]);
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post('/register/build-your-profile',[
                'user_id' => factory(User::class),
                'position' => 'hello',
                'date_of_employment' =>"2020-02-01",
                'pto' => 5,
                'points'=> 5,
            ]);

        $response->assertRedirect('/register/avatar');
    }
}


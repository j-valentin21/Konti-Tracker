<?php

namespace Tests\Feature;

use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guest cannot access dashboard profile view without being authenticated.
     *
     * @return void
     */
    public function test_Guest_Cannot_Access_Dashboard_Profile_View()
    {

        $response = $this->get('/dashboard/profile');

        $response->assertRedirect('/');
    }
    /**
     * User can update profile data on dashboard profile view.
     *
     * @return void
     */
    public function test_User_Can_Update_Profile_On_Dashboard_Profile_View()
    {
        $user = factory(user::class)->create();
        $profile = factory(Profile::class)->create();

        $input_user = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        $input = [
            'position' => $profile->position,
            'pto' => $profile->pto,
            'points' => $profile->points,
            'avatar' => $profile->avatar,
            'user_id' => $user->id
        ];
        $response = $this->actingAs($user)
            ->put('/dashboard/profile', [$input_user, $input]);

        $this->assertDatabaseHas('users', $input_user);
        $this->assertDatabaseHas('profiles', $input);
        $response->assertStatus(302);
    }

    /**
     * User can delete avatar on dashboard profile view.
     *
     * @return void
     */
    public function User_Can_delete_Avatar_On_Dashboard_Profile_View()
    {
        $user = factory(user::class)->create();
        $profile = factory(Profile::class)->create([
            'avatar' => 'randomavatar.jpg'
        ]);

        $delete = ['avatar' => 'randomavatar.jpg'];

        $response = $this->actingAs($user)
            ->delete('/dashboard/remove-avatar', $delete);

        $this->assertDatabasemissing('profiles', $delete);
        $response->assertStatus(302);
    }
}
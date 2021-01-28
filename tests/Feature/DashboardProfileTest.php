<?php

namespace Tests\Feature;

use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DashboardProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function test_Guest_Cannot_Access_Dashboard_Profile_View():void
    {

        $response = $this->get('/dashboard/profile');

        $response->assertRedirect('/');
    }

    public function User_Can_delete_Avatar_On_Dashboard_Profile_View():void
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

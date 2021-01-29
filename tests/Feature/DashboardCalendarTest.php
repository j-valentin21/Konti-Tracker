<?php

namespace Tests\Feature;

use App\Calendar;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DashboardCalendarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_Guest_Cannot_Access_Dashboard_Calendar_View():void
    {
        $response = $this->get('/dashboard/calendar');

        $response->assertRedirect('/');
    }

    public function A_User_Can_Delete_Calendar_Event():void
    {
        $user = factory(User::class)->create();
        $calendar = factory(Calendar::class)->create();

         $this->actingAs($user)
            ->delete('/dashboard/calendar/' . $user->id);

        $this->assertcount(0, Calendar::all());
    }

    public function a_User_Can_Store_Calendar_Event():void
    {
        $user = factory(user::class)->create();

        $input = [
            'id' => 1,
            'user_id' => 1 ,
            'event_name' => "meeting",
            'start_date' => 2020-11-10,
            'end_date' => 2020-11-11
        ];

         $this->actingAs($user)
            ->post('/dashboard/calendar',$input);

        $this->assertCount(1, Calendar::all());
    }
}

<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DashboardPtoPointsTest extends TestCase
{
    use DatabaseTransactions;

//    public function test_Dashboard_Pto_Points_Can_view_Properly():void
//    {
//        $user = factory(User::class)->create();
//
//        $this->withoutExceptionHandling();
//        $response =  $this->actingAs($user)
//            ->get('/dashboard/pto-points-data');
//
//        $response->assertStatus(200);
//    }

    public function test_Guest_Cannot_Access_Dashboard_PtoPoints_View():void
    {
        $response = $this->get('/dashboard/pto-points-data');

        $response->assertRedirect('/');
    }
}

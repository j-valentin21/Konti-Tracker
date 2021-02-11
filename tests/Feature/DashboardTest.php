<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use DatabaseTransactions;

    public function test_Build_Your_Profile_View_Is_Working_Properly():void
    {
        $this->withoutMiddleware();

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_Guest_Cannot_Access_Dashboard():void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/');
    }

    public function test_Guest_Cannot_Access_Pto_Chart_Data():void
    {
        $response = $this->get('/dashboard/pto-chart');

        $response->assertRedirect('/');
    }

    public function test_Guest_Cannot_Access_Points_Chart_Data():void
    {
        $response = $this->get('/dashboard/points-chart');

        $response->assertRedirect('/');
    }
}


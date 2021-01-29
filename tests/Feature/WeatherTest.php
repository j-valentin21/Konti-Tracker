<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    use DatabaseTransactions;

    public function test_Guest_Cannot_Access_Weather_View():void
    {
        $response = $this->get('/dashboard/weather');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}

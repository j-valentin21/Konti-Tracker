<?php

namespace Tests\Unit;

use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to check it expireDate method is calculating properly.
     *
     */
    public function test_Expire_Date_Method():void
    {
        $profile = new Profile();
        $expireDate = $profile->expireDate();
        $days = 60*60*24*2;
        $this->assertEquals($expireDate, $days);
    }

    /**
     * Test to check it expireDate method is calculating properly.
     *
     */
    public function test_Get_Bar_Chart_Month():void
    {
        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create();
        $barMonth = $profile->getBarChartMonth();

        $graph_date = $profile->updated_at;
        $graph_month = $graph_date->shortEnglishMonth;

        $this->assertEquals($barMonth, $graph_month);
    }
}

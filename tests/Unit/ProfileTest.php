<?php

namespace Tests\Unit;

use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;

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

    /**
     * Test to check it expireDate method is calculating properly.
     *
     */
    public function test_Reset_Months():void
    {
        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create();

        $graph_date = $profile->updated_at;
        $graph_year = $graph_date->year;
        $year_count = $profile->user->year_count = $graph_year;
        $months = array('Jan' => 6, 'Feb' => 4, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'June' => 0,
            'July' => 6, 'Aug' => 4, 'Sept' => 4, 'Oct' => 10, 'Nov' => 4, 'Dec' => 8);
        $profile->pto_usage = $months;
        $profile->points_usage = $months;
        $profile->resetMonths();

        $reset = array('Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'June' => 0,
            'July' => 0, 'Aug' => 0, 'Sept' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0);

        $this->assertEquals($reset, $profile->pto_usage);
        $this->assertEquals($reset, $profile->points_usage);
        $this->assertGreaterThan($year_count, $profile->user->year_count);
    }
}

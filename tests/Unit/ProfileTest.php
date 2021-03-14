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
     * Test to check if expireDate method is calculating properly.
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
     * Test to check if correct month for charts is returning properly.
     *
     */
    public function test_Get_Bar_Chart_Month():void
    {
        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create();
        $barMonth = $profile->getChartMonth();

        $graph_date = $profile->updated_at;
        $graph_month = $graph_date->shortEnglishMonth;

        $this->assertEquals($barMonth, $graph_month);
    }

    /**
     * Test to check it $months array resets properly and year_count increments by 1.
     *
     */
//    public function test_Reset_Months():void
//    {
//        $user = factory(User::class)->create();
//        $profile = factory(Profile::class)->create();
//
//        $graph_date = $profile->updated_at;
//        $graph_year = $graph_date->year;
//        $year_count = $profile->user->year_count = $graph_year;
//        $months = array('Jan' => 6, 'Feb' => 4, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'June' => 0,
//            'July' => 6, 'Aug' => 4, 'Sept' => 4, 'Oct' => 10, 'Nov' => 4, 'Dec' => 8);
//        $profile->pto_usage = $months;
//        $profile->points_usage = $months;
//        $profile->resetMonths();
//
//        $reset = array('Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'June' => 0,
//            'July' => 0, 'Aug' => 0, 'Sept' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0);
//
//        $this->assertEquals($reset, $profile->pto_usage);
//        $this->assertEquals($reset, $profile->points_usage);
//        $this->assertGreaterThan($year_count, $profile->user->year_count);
//    }

    /**
     * Test to check if correct month for charts is returning properly.
     *
     */
    public function test_Sort_Months():void
    {
        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create();

        $unsortedMonths = array(5 => 6, 0 => 4, 2 => 0, 8 => 0, 3 => 0, 7 => 0,
            9 => 6, 11 => 4, 10 => 10, 1 => 4, 4 => 5, 6 => 4);

        $sortedMonths = array(0 => 4, 1 => 4, 2 => 0, 3 => 0, 4 => 5,  5 => 6,
            6 => 4, 7 => 0, 8 => 10, 9 => 6, 10 => 10, 11 => 4,);
        $sorted = $profile->sortMonths($unsortedMonths);

        $this->assertEquals($sorted['Jan'], $sortedMonths[0]);
        $this->assertEquals($sorted['Apr'], $sortedMonths[3]);
        $this->assertEquals($sorted['July'], $sortedMonths[6]);
        $this->assertEquals($sorted['Dec'], $sortedMonths[11]);
    }

    /**
     * Test to check if correct month is sorting by month.
     *
     */
    public function test_Sort_Months_By_Month():void
    {
        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create();

        $unsortedMonths = array(
            'Jan' => 3,
            'July' => 5,
            'Mar' => 1,
            'Aug' => 3,
            'Oct' => 3,
            'June' => 5,
            'May' => 4,
            'Sept' => 5,
            'Apr' => 6,
            'Nov' => 4,
            'Feb' => 3,
            'Dec' => 3,
        );

        $sorted = $profile->sortMonthsByMonth($unsortedMonths);

        $this->assertEquals($sorted['Jan'], $unsortedMonths['Jan']);
        $this->assertEquals($sorted['Apr'], $unsortedMonths['Apr']);
        $this->assertEquals($sorted['July'], $unsortedMonths['July']);
        $this->assertEquals($sorted['Dec'], $unsortedMonths['Dec']);
    }

}

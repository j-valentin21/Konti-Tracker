<?php

namespace Tests\Unit;

use App\Profile;
use PHPUnit\Framework\TestCase;

class ProfileTest extends TestCase
{
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
}

<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function profile ()
    {
        $profile = factory(profile::class)->create();
    }
}

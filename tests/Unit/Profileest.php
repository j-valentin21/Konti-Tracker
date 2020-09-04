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
    public function test ()
    {
        $this->withoutExceptionHandling();

        //executes the factory created in the factory folder Book class
        $profile = factory(profile::class)->create();


    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactUsTest extends TestCase
{
    public function test_Contact_Us_View_is_Responding_With_Status_Code_200()
    {
        $response = $this->get('/contact-us');

        $response->assertStatus(200);
    }
}

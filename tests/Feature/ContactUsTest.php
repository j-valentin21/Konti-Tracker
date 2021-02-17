<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactUsTest extends TestCase
{
    public function test_Contact_Us_View_is_Responding_With_Status_Code_200()
    {
        $response = $this->get('/contact-us');

        $response->assertStatus(200);
    }

    public function test_User_Can_Send_Contact_Message()
    {
        $response = $this->post('/contact-us', [
            'name' => 'James',
            'email' => 'james@gmail.com',
            'message' => 'This is a test message'
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/');
    }
}

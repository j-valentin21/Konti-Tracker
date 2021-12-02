<?php

namespace Tests\Feature;

use App\Http\Requests\ContactUsRequest;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Validation\Validator;
use Tests\TestCase;

class ContactUsRequestTest extends TestCase
{
    use DatabaseTransactions;

    /** @var ContactUsRequest */
    private $rules;

    /** @var Validator */
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');

        $this->rules = (new ContactUsRequest())->rules();
    }

    public function validationProvider()
    {
        /* WithFaker trait doesn't work in the dataProvider */
        $faker = Factory::create( Factory::DEFAULT_LOCALE);

        return [
            'request_should_fail_when_no_position_is_name_is_provided' => [
                'passed' => false,
                'data' => [
                    'email' => $faker->email,
                    'message' => $faker->paragraph(),
                ]
            ],
            'request_should_fail_when_no_email_is_provided' => [
                'passed' => false,
                'data' => [
                    'name' => $faker->name,
                    'message' => $faker->paragraph(),
                ]
            ],
            'request_should_fail_when_no_message_is_provided' => [
                'passed' => false,
                'data' => [
                    'name' => $faker->name,
                    'email' => $faker->email,
                ]
            ],
            'request_should_fail_when_name_has_more_than_75_characters' => [
                'passed' => false,
                'data' => [
                    'name' => $faker->name
                ]
            ],
            'request_should_fail_when_if_email_is_using_the_wrong_format' => [
                'passed' => false,
                'data' => [
                    'email' => $faker->email
                ]
            ],
            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'data' => [
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'message' => $faker->paragraph(),
                    'g-recaptcha-response' => '1',
                ]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider validationProvider
     * @param bool $shouldPass
     * @param array $mockedRequestData
     */
    public function validation_results_as_expected(bool $shouldPass, array $mockedRequestData):void
    {
        $this->assertEquals(
            $shouldPass,
            $this->validate($mockedRequestData)
        );
    }

    protected function validate($mockedRequestData)
    {
        return $this->validator
            ->make($mockedRequestData, $this->rules)
            ->passes();
    }
}

<?php

namespace Tests\Feature;

use App\Http\Requests\FirstTimeRegistrationRequest;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\Validator;
use Tests\TestCase;

class FirstTimeRegistrationRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @var FirstTimeRegistrationRequest */
    private $rules;

    /** @var Validator */
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');

        $this->rules = (new FirstTimeRegistrationRequest())->rules();
    }

    public function validationProvider()
    {
        /* WithFaker trait doesn't work in the dataProvider */
        $faker = Factory::create( Factory::DEFAULT_LOCALE);

        return [
            'request_should_fail_when_no_position_is_provided' => [
                'passed' => false,
                'data' => [
                    'points' => $faker->numberBetween(0,15),
                    'pto' => $faker->numberBetween(0, 40)
                ]
            ],
            'request_should_fail_when_no_points_is_provided' => [
                'passed' => false,
                'data' => [
                    'position' => $faker->word,
                    'pto' => $faker->numberBetween(0, 40)
                ]
            ],
            'request_should_fail_when_no_pto_is_provided' => [
                'passed' => false,
                'data' => [
                    'position' => $faker->word,
                    'points' => $faker->numberBetween(0, 15)
                ]
            ],
            'request_should_fail_when_position_has_more_than_50_characters' => [
                'passed' => false,
                'data' => [
                    'position' => $faker->paragraph()
                ]
            ],
            'request_should_fail_if_points_is_not_a_integer' => [
                'passed' => false,
                'data' => [
                    'points' => $faker->word()
                ]
            ],
            'request_should_fail_if_pto_is_not_a_integer' => [
                'passed' => false,
                'data' => [
                    'pto' => $faker->word()
                ]
            ],
            'request_should_fail_if_points_are_not_an_integer_between_0_15' => [
                'passed' => false,
                'data' => [
                    'points' => $faker->numberBetween(0,15)
                ]
            ],
            'request_should_fail_if_pto_are_not_an_integer_between_0_40' => [
                'passed' => false,
                'data' => [
                    'pto' => $faker->numberBetween(0,40)
                ]
            ],
            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'data' => [
                    'position' => $faker->word(),
                    'pto' => $faker->numberBetween(0,40),
                    'points' => $faker->numberBetween(0,15)
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
    public function validation_results_as_expected(bool $shouldPass, array $mockedRequestData)
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

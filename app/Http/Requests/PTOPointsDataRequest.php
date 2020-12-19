<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PTOPointsDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pto_used.*' => 'required|numeric|between:0,40',
            'points_used.*' => 'required|int|between:0,15'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pto_used.*.required' => 'All PTO Used fields are required to update',
            'pto_used.*.numeric' => 'All PTO Used fields must be an integer to update',
            'pto_used.*.between' => 'All PTO Used fields must be between 0 and 40',
            'points_used.*.required' => 'All Points Used fields are required to update',
            'points_used.*.int' => 'All Points Used fields must be an integer to update',
            'points_used.*.between' => 'All Points Used fields must be between 0 and 15',
        ];
    }
}

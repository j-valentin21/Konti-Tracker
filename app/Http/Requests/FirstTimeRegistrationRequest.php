<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FirstTimeRegistrationRequest extends FormRequest
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
            'position' => 'required|max:50',
            'pto' => 'required|integer|between:0,40',
            'points' => 'required|integer|between:0,15',
            'date_of_employment' => 'required|date',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FirstTimeRegistrationValidation extends FormRequest
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
            'position' => 'required| max=50',
            'image' => 'image|mimes:jpeg,bmp,png|file|max:1000'
        ];
    }
}

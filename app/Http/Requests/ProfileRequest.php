<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'string| max:100',
            'email' => 'required|unique:users,email,'.auth()->user()->id,
            'position' => 'max:50',
            'pto' => 'integer|between:0,40',
            'points' => 'integer|between:0,15',
            'avatar' => 'max:2000|mimes:jpg,png,jpeg,svg,gif'
        ];
    }
}

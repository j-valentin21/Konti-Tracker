<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PTOFormRequest extends FormRequest
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
        $date = $this->request->get('datesArray');
        $count = count($date);

        return [
            'ptoDays' => 'required|numeric|max:40',
            'reason' => 'required|string|min:5|max:100',
            'date' => 'required',
            'startTime' => 'array|min:' . $count,
            'startTime.*' => 'required',
            'endTime' => 'array|min:' . $count,
            'endTime.*' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *.
     * @return array
     */
    public function messages()
    {
        return [
            'reason.required' => 'The reason for request field is required',
            'startTime.required' => 'All start time fields are required',
            'endTime.required'  => 'All end time fields are required',
        ];
    }

}

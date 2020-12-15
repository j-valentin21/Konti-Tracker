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
        $pto = $this->request->get('actualPTO');

        return [
            'pto_days' => 'required|numeric|max:' . $pto,
            'reason_for_request' => 'required|string|min:5|max:100',
            'dates' => 'required',
            'start_times' => 'array|min:' . $count,
            'end_times' => 'array|min:' . $count,
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
            'pto_days.max' => 'Your PTO days request cannot exceed your actual PTO days available',
            'reason.required' => 'The reason for request field is required',
            'start_times.min' => 'All start time fields are required',
            'end_times.min'  => 'All end time fields are required',
            'start_times.required' => 'All start time fields are required',
            'end_times.required'  => 'All end time fields are required',
        ];
    }
}

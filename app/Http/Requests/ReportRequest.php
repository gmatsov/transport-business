<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'truck_id' => 'required|exists:trucks,id',
            'month' => 'numeric|between:1,12',
            'year' => 'numeric|between:1970,2100',
        ];
    }

    public function messages()
    {
        return [
            'truck_id.required' => 'Полето е задължително',
            'truck_id.exists' => 'Невалиден номер',
            'month.between' => 'Невалиден месец',
            'year.between' => 'Невалидна година',

        ];
    }
}

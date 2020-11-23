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
            'truck_id' => 'exists:trucks,id,deleted_at,NULL|nullable',
            'start_month' => 'numeric|between:1,12',
            'end_month' => 'numeric|between:1,12',
            'start_year' => 'numeric|between:1970,2100',
            'end_year' => 'numeric|between:1970,2100',
        ];
    }

    public function messages()
    {
        return [
            'truck_id.required' => 'Полето е задължително',
            'truck_id.exists' => 'Невалиден номер',
            'start_month.between' => 'Невалиден месец',
            'end_month.between' => 'Невалиден месец',
            'start_year.between' => 'Невалидна година',
            'end_year.between' => 'Невалидна година',
        ];
    }
}

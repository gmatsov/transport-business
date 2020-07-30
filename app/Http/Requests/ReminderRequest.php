<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReminderRequest extends FormRequest
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
            'title' => 'required',
            'by_date' => 'date|after:yesterday',
            'days_before' => 'integer|between:0,30',
            'by_odometer' => 'nullable|integer|between:0,1000000',
            'km_before' => 'nullable|integer|between:0,5000'
        ];
    }

    public function messages()
    {
        return [
            'truck_id.required' => 'Полето е задължително',
            'truck_id.exists' => 'Невалиден камион',
            'title.required' => 'Полето е задължително',
            'by_date.after' => 'Датата трябва да не е в миналото',
            'days_before.between' => 'Дните трябва да са между 0 и 30',
            'by_odometer.between' => 'Километрите трябва да са между 1 и 1000000',
            'km_before.between' => 'Километрите трябва да са между 0 и 5000',
        ];
    }
}

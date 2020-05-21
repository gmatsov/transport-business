<?php

namespace App\Http\Requests;

use App\Models\Truck;
use Illuminate\Foundation\Http\FormRequest;

class CreateRefuelRequest extends FormRequest
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
        $min_odometer = Truck::where('id', $this->truck_id)->pluck('odometer')->first() + 1;
        return [
            'truck_id' => 'integer',
            'reporting_period_id' => 'integer',
            'date' => 'date|before:tomorrow',
            'quantity' => 'required|numeric|between:0.01,2000',
            'price' => 'required|numeric|between:0.01,5000',
            'current_odometer' => 'integer|between:' . $min_odometer . ',999999',
            'note' => 'nullable|string'
        ];
    }

    public function messages()
    {
        $min_odometer = Truck::where('id', $this->truck_id)->pluck('odometer')->first();

        return [
            'date' => 'Невалидна дата',
            'date.before' => 'Не може да зареждате с дата в бъдещето',
            'quantity.required' => 'Задължително поле Количество',
            'quantity.between' => 'Количеството трябва да бъде между 0.01 и 2000.00 литра',
            'price.required' => 'Задължително поле Цена',
            'price.between' => 'Цената трябва да бъде между 0.01 и 5000.00 Евро',
            'current_odometer.between' => 'Километража трябва дa бъде между ' . $min_odometer . ' и 999 999 км.',
            'current_odometer.integer' => 'Километража трябва дa бъде число между ' . $min_odometer . ' и 999 999 км.'
        ];
    }
}

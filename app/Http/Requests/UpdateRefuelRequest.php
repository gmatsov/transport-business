<?php

namespace App\Http\Requests;

use App\Models\Truck;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRefuelRequest extends FormRequest
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
            'date' => 'date|before:tomorrow',
            'quantity' => 'required|numeric|between:0.01,2000',
            'price' => 'required|numeric|between:0.01,5000',
            'current_odometer' => 'integer|between:1,999999',
            'note' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'date' => 'Невалидна дата',
            'date.before' => 'Не може да зареждате с дата в бъдещето',
            'quantity.required' => 'Задължително поле Количество',
            'quantity.between' => 'Количеството трябва да бъде между 0.01 и 2000.00 литра',
            'price.required' => 'Задължително поле Цена',
            'price.between' => 'Цената трябва да бъде между 0.01 и 5000.00 Евро',
            'current_odometer.between' => 'Километража трябва дa бъде между 1 и 999 999 км.',
            'note.max' => 'Максимална дължина на бележката 255 символа'
        ];
    }
}

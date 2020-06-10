<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaidTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'distance' => 'integer|between:1,9999',
            'price_per_km' => 'numeric|between:0.01,9.99'
        ];
    }

    public function messages()
    {
        return [
            'distance.integer' => 'Изминати км трябва да е число между 1 и 9999 км.',
            'distance.between' => 'Изминати км трябва да са между 1 и 9999 км.',
            'price_per_km.between' => 'Цена за км. трябва да е между 0.01 и 9.99',
            'price_per_km.numeric' => 'Цена за км. трябва да е между 0.01 и 9.99',
        ];
    }
}

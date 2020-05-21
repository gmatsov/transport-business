<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTruckRequest extends FormRequest
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
            'licence_plate' => 'string',
            'vin' => 'string|nullable|max:17',
            'emission_class' => 'string|nullable',
            'brand' => 'string|nullable',
            'model' => 'nullable|string',
            'production_year' => 'nullable|integer',
            'horse_power' => 'nullable|integer|between:1,1500'
        ];
    }

    public function messages()
    {
        return [
            'licence_plate.string' => 'Невалиден регистрационен номер',
            'horse_power.between' => 'Мощността трябва да е между 1 и 1500 к.с.',
            'vin.max' => 'Номера на рамата трябва да бъде до 17 символа'
        ];
    }
}

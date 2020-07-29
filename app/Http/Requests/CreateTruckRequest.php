<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTruckRequest extends FormRequest
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
            'licence_plate' => 'string|unique:trucks',
            'odometer' => 'integer|min:0',
            'vin' => 'nullable|unique:trucks',
            'emission_class' => 'string|nullable',
            'brand' => 'string|nullable',
            'model' => 'nullable|string',
            'production_year' => 'nullable|integer',
            'horse_power' => 'nullable|integer|between:1,1500',
        ];
    }

    public function messages()
    {
        return [
            'licence_plate.string' => 'Регистрационния номер е задължителен',
            'licence_plate.unique' => 'Регистрационния номер е зает',
            'vin.unique' => 'Номера на рамата е зает',
            'odometer.integer' => 'Километрите трябва да са цяло число от 1 до 1 000 000',
            'horse_power.between' => 'Мощността трябва да е между 1 и 1500 к.с.',
        ];
    }
}

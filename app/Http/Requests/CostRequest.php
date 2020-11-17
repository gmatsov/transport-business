<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CostRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'Задължително поле.',
            'price.min' => 'Минимална сума 0.'
        ];
    }
}

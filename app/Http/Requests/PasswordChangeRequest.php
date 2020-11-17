<?php

namespace App\Http\Requests;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'old_password' => ['required', 'min:8', new CurrentPasswordCheckRule],
            'new_password' => ['required', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'confirmed', 'different:old_password'],
            'new_password_confirmation' => ['required', 'min:3'],
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Задължителна стара парола',
            'new_password.required' => 'Задължителна нова парола',
            'new_password.different' => 'Стара и новата пароли трябва да са различни',
            'new_password.confirmed' => 'Двете нови пароли трябва да съвпадат',
            'new_password_confirmation.required' => 'Задължителна повторение на парола'

        ];
    }
}

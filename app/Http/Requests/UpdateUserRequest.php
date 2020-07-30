<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'nullable|string|min:2',
            'last_name' => 'nullable|string|min:2',
            'username' => 'string|min:3|unique:users,username,' . auth()->id(),
            'email' => 'unique:users,email,' . auth()->id(),
            'password' => 'required|password',
        ];
    }

    public function messages()
    {
        return [
            'first_name.between' => 'Първото име трябва да е минимум 2 символа',
            'username.unique' => 'Веведеното потребителско име е заето',
            'username.string' => 'Потребителското име трябва да е поне 3 символа',
            'username.min' => 'Потребителското име трябва да е поне 3 символа',
            'email.unique' => 'Въведеният имейл адрес е зает',
            'password.required' => 'Паролата е задължителна',
            'password.password' => 'Грешна парола',
        ];
    }
}

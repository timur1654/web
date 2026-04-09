<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login' => 'required|min:4',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
          'required' => 'Это поле обязательно для заполнения',
          'login.min' => 'Логин должен состоять минимум из 4 символов',
          'password.min' => 'Пароль должен состоять минимум из 6 символов',
        ];
    }
}

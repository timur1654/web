<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|regex:/^[А-Яа-яЁё\s-]+$/u',
            'surname' => 'required|regex:/^[А-Яа-яЁё\s-]+$/u',
            'patronymic' => 'nullable|regex:/^[А-Яа-яЁё\s-]+$/u',
            'login' => 'required|unique:users,login|regex:/^[A-Za-z0-9-]+$/u',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Это поле обязательно для заполнения',
            'name.regex' => 'Доступно только кирилица, пробел и тире',
            'surname.regex' => 'Доступно только кирилица, пробел и тире',
            'patronymic.regex' => 'Доступно только кирилица, пробел и тире',
            'login.regex' => 'Доступно только латиница, цифры и тире',
            'login.unique' => 'Данный логин уже занят',
            'email.unique' => 'Данная почта занята',
            'email.email' => 'Должна быть почта',
            'password.min' => 'Пароль должен состоять минимум из 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}

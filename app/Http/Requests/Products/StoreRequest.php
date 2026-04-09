<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required|file|mimes:png,jpeg,bmp|max:10240|image',
            'country' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|numeric',
            'count' => 'required|numeric',
            'description' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
          'required' => 'Это поле обязательно для заполнения',
          'numeric' => 'Должно быть число',
          'min' => 'Цена должна быть не меньше 0',
          'image' => 'Должно быть фото',
          'image.max' => 'Не более 10240',
          'image.mimes' => 'Разрешенные форматы: png, jpeg, bmp',
          'description.max' => 'Не более 500 символов',
        ];
    }
}

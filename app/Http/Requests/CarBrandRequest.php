<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Разрешаем выполнение запроса для всех пользователей
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:car_brands,title',
        ];
    }
}

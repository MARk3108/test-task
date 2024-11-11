<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\ValidationExceptionHandler;

class CarBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:car_brands,title'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        ValidationExceptionHandler::handle($validator);
    }
}

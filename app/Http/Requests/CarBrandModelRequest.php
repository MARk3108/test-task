<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\ValidationExceptionHandler;

class CarBrandModelRequest extends FormRequest
{
    public function rules(): array
    {
        $carBrandId = $this->route('carBrand')->id; 

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:car_brand_models,title,NULL,id,car_brand_id,' . $carBrandId 
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        ValidationExceptionHandler::handle($validator);
    }
}
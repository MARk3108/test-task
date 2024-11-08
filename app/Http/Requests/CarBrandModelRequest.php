<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarBrandModelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255'            
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
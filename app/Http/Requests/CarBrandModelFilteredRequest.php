<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarBrandModelFilteredRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255'            
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
<?php
namespace App\Exceptions;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidationExceptionHandler
{
    public static function handle(Validator $validator)
    {
        $response = [
            'error' => 'Validation failed',
            'details' => $validator->errors(),
        ];

        throw new HttpResponseException(
            response()->json($response, 422)
        );
    }
}

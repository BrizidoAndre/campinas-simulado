<?php

namespace App\Http\Requests;

use App\bases\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        ApiResponse::errorResponse(400, 'Validation failed');
    }

    public function authorize()
    {
        return true;
    }
}

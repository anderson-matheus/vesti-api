<?php

namespace App\Http\Requests\Api\Authorization;

use Illuminate\Foundation\Http\FormRequest;

class LoginAuthorizationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }
}
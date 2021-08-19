<?php

namespace App\Http\Requests\Api\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:4|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255',
        ];
    }
}

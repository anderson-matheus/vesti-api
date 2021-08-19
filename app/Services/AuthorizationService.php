<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Exception;

class AuthorizationService
{
    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            throw new Exception('Unauthorized');
        }

        $token = Auth::user()->createToken('VestiApiAuthApp')->accessToken;
        return $token;
    }

    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Authorization\LoginAuthorizationRequest;
use App\Services\AuthorizationService;
use Exception;

class ApiAuthorizationController extends Controller
{
    private $authorizationService;

    public function __construct()
    {
        $this->authorizationService = new AuthorizationService();
    }

    public function login(LoginAuthorizationRequest $request)
    {
        try {
            $token = $this->authorizationService->login($request->all());
            return response()->json(['token' => $token], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->authorizationService->logout();
            return response()->json(['message' => 'logged out'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
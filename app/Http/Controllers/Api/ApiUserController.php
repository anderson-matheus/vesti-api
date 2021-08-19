<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Users\StoreUserRequest;
use App\Repositories\UserRepository;
use Exception;

class ApiUserController extends Controller
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = $this->userRepository->store($request->all());
            return response()->json(['user' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        
    }
}
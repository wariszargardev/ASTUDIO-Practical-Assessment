<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(UserRegistrationRequest $request)
    {
        try {
            $result = $this->authService->register($request->safe()->toArray());
            return response()->json($result, 201);
        } catch (\Exception $e) {
            Log::error("Error registering user: {$e->getMessage()}");
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function login(UserLoginRequest $request)
    {
        try {
            $result = $this->authService->login($request->safe()->toArray());
            return response()->json($result, 201);
        } catch (\Exception $e) {
            Log::error("Error login user: {$e->getMessage()}");
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function logout(Request $request)
    {
        try {
            $result = $this->authService->logout($request);
            if ($result){
                return response()->json(['message' => 'User logged out successfully'], 200);
            }
            return response()->json(['message' => 'User not logged in'], 400);
        } catch (\Exception $e) {
            Log::error("Error logout user: {$e->getMessage()}");
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function profile()
    {
        return response()->json(auth()->user(), 200);
    }
}

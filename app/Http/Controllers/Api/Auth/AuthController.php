<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
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

    public function login(Request $request)
    {
    }

    public function logout(Request $request)
    {
    }
}

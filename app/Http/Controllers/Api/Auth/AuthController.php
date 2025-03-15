<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helper\ApiResponse;
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

    /**
     * Register a new user.
     */
    public function register(UserRegistrationRequest $request)
    {
        try {
            $result = $this->authService->register($request->safe()->toArray());
            Log::info("User registered successfully with email: {$request->email}");
            return ApiResponse::successResponse($result, self::SUCCESS_MESSAGE, self::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error("Error registering user: {$e->getMessage()}");
            return ApiResponse::errorResponse($e->getMessage(), self::ERROR_STATUS, self::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Log in an existing user.
     */
    public function login(UserLoginRequest $request)
    {
        try {
            $result = $this->authService->login($request->safe()->toArray());
            Log::info("User login successfully with email: {$request->email}");
            return ApiResponse::successResponse($result, self::SUCCESS_MESSAGE, self::HTTP_OK);
        } catch (\Exception $e) {
            Log::error("Error login user: {$e->getMessage()}");
            return ApiResponse::errorResponse($e->getMessage(), self::ERROR_STATUS, self::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(Request $request)
    {
        try {
            $result = $this->authService->logout($request);
            if ($result){
                return ApiResponse::successResponse([], self::LOGOUT_MESSAGE, self::HTTP_OK);
            }
            return ApiResponse::errorResponse( self::NOT_FOUND_MESSAGE, self::ERROR_STATUS , self::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error("Error logout user: {$e->getMessage()}");
            return ApiResponse::errorResponse($e->getMessage(), self::ERROR_STATUS, self::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get the authenticated user's profile.
     */
    public function profile()
    {
        $user = auth()->user();
        return ApiResponse::successResponse($user, self::SUCCESS_MESSAGE, self::HTTP_OK);
    }
}

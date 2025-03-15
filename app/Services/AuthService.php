<?php

namespace App\Services;

use App\Models\User;
use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class AuthService extends BaseService
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Register a new user and return an access token.
     */
    public function register($request)
    {
        $request['password'] = Hash::make($request['password']);
        $user = $this->authRepository->register($request);
        $token = $user->createToken('AuthToken')->accessToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Login user and return an access token.
     */
    public function login(array $data)
    {
        if (!auth()->attempt($data)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('AuthToken')->accessToken;

        return [
            'token' => $token,
        ];
    }

    /**
     * Logout the authenticated user by revoking their token.
     */
    public function logout(Request $request)
    {
        $authUser= Auth::user();
        if ($authUser) {
            $authUser->token()->revoke();
            return true;
        }
        return false;
    }
}

<?php

namespace App\Repository;

use App\Models\User;

class AuthRepository
{
    /**
     * Register a new user and return an access token.
     */
    public function register($data){
        return User::create($data);
    }
}

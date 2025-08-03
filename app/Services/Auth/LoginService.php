<?php

namespace App\Services\Auth;

class LoginService
{
    public function __construct()
    {
        //
    }

    /**
     * Create token for user.
     */
    public function createToken($authUser)
    {
        $token = $authUser->createToken('auth-token')->plainTextToken;

        return $token;
    }
}

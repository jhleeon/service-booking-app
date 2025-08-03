<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    public function __construct()
    {
        //
    }

    /**
     * Create a user in Database.
     */
    public function registration($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  Hash::make($data['password']),
        ]);

        return $user;
    }
}

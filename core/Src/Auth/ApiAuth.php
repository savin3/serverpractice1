<?php

namespace Src\Auth;

use Model\ApiToken;
use Model\User;

class ApiAuth
{
    public static function getUserByToken(string $token): ?User
    {
        $tokenRecord = ApiToken::where('token', $token)->first();
        if (!$tokenRecord) {
            return null;
        }
        return User::find($tokenRecord->user_id);
    }

    public static function generateToken(User $user): string
    {
        $token = bin2hex(random_bytes(32));
        ApiToken::create([
            'user_id' => $user->id,
            'token' => $token
        ]);
        return $token;
    }
}
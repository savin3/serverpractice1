<?php

namespace Controller;

use Src\Request;
use Src\View;
use Src\Auth\Auth;
use Src\Auth\ApiAuth;

class ApiAuthController
{
    public function login(Request $request): void
    {
        $login = $request->get('login');
        $password = $request->get('password');

        if (!$login || !$password) {
            (new View())->toJSON(['error' => 'Login and password required'], 400);
            return;
        }

        if (!Auth::attempt(['login' => $login, 'password' => $password])) {
            (new View())->toJSON(['error' => 'Invalid credentials'], 401);
            return;
        }

        $user = Auth::user();
        $token = ApiAuth::generateToken($user);

        (new View())->toJSON(['token' => $token]);
    }
}
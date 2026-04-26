<?php

namespace Middlewares;

use Src\Request;
use Src\Auth\ApiAuth;

class BearerTokenMiddleware
{
    public function handle(Request $request): void
    {
        $authHeader = $request->headers['Authorization'] ?? '';

        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            http_response_code(401);
            echo json_encode(['error' => 'Token required']);
            exit;
        }

        $token = $matches[1];
        $user = ApiAuth::getUserByToken($token);

        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid token']);
            exit;
        }

        $GLOBALS['api_user'] = $user;
    }
}
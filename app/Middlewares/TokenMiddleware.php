<?php

namespace Middlewares;

use Model\User;
use Src\Request;
use Src\View;

class TokenMiddleware
{
    public function handle(Request $request): void
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION']
            ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION']
            ?? $request->headers['Authorization']
            ?? $request->headers['authorization']
            ?? null;

        if (!$authHeader || substr($authHeader, 0, 7) !== 'Bearer ') {
            (new View())->toJSON(['error' => 'Токен не предоставлен'], 401);
        }

        $token = substr($authHeader, 7);
        $user = User::where('token', $token)->first();

        if (!$user) {
            (new View())->toJSON(['error' => 'Неверный токен'], 401);
        }

        $request->set('authUser', $user);
    }
}

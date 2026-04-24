<?php

namespace Controller;

use Src\View;
use Src\Request;
use Src\Auth\Auth;
use Model\User;

class UserController
{
    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return (new View())->render('site.login');
        }
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/dashboard');
        }
        return (new View())->render('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }
}
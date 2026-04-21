<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Employee;
use Model\User;

class AdminController
{
    public function addEmployee(): string
    {
        return (new View())->render('admin.employee_add');
    }

    public function storeEmployee(Request $request): void
    {
        $data = $request->all();
        Employee::create($data);
        app()->route->redirect('/dashboard');
    }

    public function addUser(): string
    {
        return (new View())->render('admin.user_add');
    }

    public function storeUser(Request $request): void
    {
        $data = $request->all();
        $data['password'] = md5($data['password']);
        $data['role'] = 'accountant';
        User::create($data);
        app()->route->redirect('/dashboard');
    }
}
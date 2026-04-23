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
        $positions = Employee::getPositionTypes();
        $departments = Employee::getDepartmentTypes();

        return (new View())->render('site.employee-add', [
            'positions' => $positions,
            'departments' => $departments
        ]);
    }

    public function storeEmployee(Request $request): void
    {
        Employee::create($request->all());
        app()->route->redirect('/dashboard');
    }

    public function addUser(): string
    {
        return (new View())->render('site.user-add');
    }

    public function storeUser(Request $request): void
    {
        User::create([
            'login' => $request->login,
            'password' => md5($request->password),
            'role' => 'accountant'
        ]);
        app()->route->redirect('/dashboard');
    }
}
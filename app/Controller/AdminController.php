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
        $data = $request->all();

        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/public/uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $filename);
        $data['photo'] = '/pop-it-mvc/public/uploads/' . $filename;

        Employee::create($data);
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
<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Employee;
use Model\User;
use Src\Validator\Validator;

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
        $validator = new Validator($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'patronymic' => ['required'],
            'insurance_number' => ['required', 'insuranceNumber'],
            'payer_number' => ['required', 'payerNumber'],
            'bank_account' => ['required', 'bankAccount'],
            'employee_number' => ['required', 'digits'],
            'salary' => ['required', 'positive']
        ], [
            'required' => 'Поле :field пусто',
            'positive' => 'Поле :field должно быть положительным числом',
            'insuranceNumber' => 'Неверный формат СНИЛС (XXX-XXX-XXX XX)',
            'payerNumber' => 'Неверный формат ИНН (10 или 12 цифр)',
            'bankAccount' => 'Неверный формат банковского счёта (20 цифр)',
            'digits' => 'Неверный формат табельного номера (должно содержать только цифры)',
//            'alphabet' => 'Поле :field должно содержать только буквы'
        ]);

        if ($validator->fails()) {
            $_SESSION['errors'] = $validator->errors();
            app()->route->redirect('/admin/employee/add');
            return;
        }

        Employee::create($request->all());
        app()->route->redirect('/dashboard');
    }

    public function addUser(): string
    {
        return (new View())->render('site.user-add');
    }

    public function storeUser(Request $request): void
    {
        $validator = new Validator($request->all(), [
            'login' => ['required', 'unique:users,login'],
            'password' => ['required']
        ], [
            'required' => 'Поле :field пусто',
            'unique' => 'Пользователь с таким логином уже существует'
        ]);

        if ($validator->fails()) {
            $_SESSION['errors'] = $validator->errors();
            app()->route->redirect('/admin/user/add');
            return;
        }

        User::create([
            'login' => $request->login,
            'password' => md5($request->password),
            'role' => 'accountant'
        ]);
        app()->route->redirect('/dashboard');
    }
}
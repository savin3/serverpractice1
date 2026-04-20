<?php

namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Model\Employee;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/go');
        }
        return new View('site.signup');

    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function employees(): string
    {
        $employees = Employee::all();
        return (new View())->render('site.employees', ['employees' => $employees]);
    }

    public function accruals(): string
    {
        return (new View())->render('site.accruals');
    }

    public function deductions(): string
    {
        return (new View())->render('site.deductions');
    }

    public function payslip(): string
    {
        return (new View())->render('site.payslip');
    }

    public function dashboard(): string
    {
        $employees = Employee::all();
        return (new View())->render('site.dashboard', ['employees' => $employees]);
    }

    public function employeeAccruals(int $id): string
    {
        $employee = Employee::findOrFail($id);
        return (new View())->render('site.employee_accruals', ['employee' => $employee]);
    }

    public function employeeDeductions(int $id): string
    {
        $employee = Employee::findOrFail($id);
        return (new View())->render('site.employee_deductions', ['employee' => $employee]);
    }

    public function employeePayslips(int $id): string
    {
        $employee = Employee::findOrFail($id);
        return (new View())->render('site.employee_payslips', ['employee' => $employee]);
    }
}
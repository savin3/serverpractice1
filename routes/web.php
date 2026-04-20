<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/dashboard', [Site::class, 'dashboard'])->middleware('auth');
Route::add('GET', '/accruals', [Site::class, 'accruals'])->middleware('auth');
Route::add('GET', '/deductions', [Site::class, 'deductions'])->middleware('auth');
Route::add('GET', '/payslip', [Site::class, 'payslip'])->middleware('auth');
Route::add('GET', '/employee/{id}', [Site::class, 'employee'])->middleware('auth');
Route::add('GET', '/employee/{id}/accruals', [Site::class, 'employeeAccruals'])->middleware('auth');
Route::add('GET', '/employee/{id}/deductions', [Site::class, 'employeeDeductions'])->middleware('auth');
Route::add('GET', '/employee/{id}/payslips', [Site::class, 'employeePayslips'])->middleware('auth');
Route::add(['GET', 'POST'], '/admin/employee/add', [Admin::class, 'addEmployee'])->middleware('auth');
Route::add(['GET', 'POST'], '/admin/user/add', [Admin::class, 'addUser'])->middleware('auth');
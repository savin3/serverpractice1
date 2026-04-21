<?php

use Src\Route;
use Controller\Site;
use Controller\UserController;
use Controller\EmployeeController;
use Controller\AccrualController;
use Controller\DeductionController;
use Controller\PayslipController;
use Controller\AdminController;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);

Route::add(['GET', 'POST'], '/login', [UserController::class, 'login']);
Route::add('GET', '/logout', [UserController::class, 'logout']);

Route::add('GET', '/dashboard', [EmployeeController::class, 'dashboard'])->middleware('auth');
Route::add('GET', '/employee/{id}', [EmployeeController::class, 'employee'])->middleware('auth');
Route::add('GET', '/employee/{id}/accruals', [EmployeeController::class, 'employeeAccruals'])->middleware('auth');
Route::add('GET', '/employee/{id}/deductions', [EmployeeController::class, 'employeeDeductions'])->middleware('auth');
Route::add('GET', '/employee/{id}/payslips', [EmployeeController::class, 'employeePayslips'])->middleware('auth');

Route::add('GET', '/accruals', [AccrualController::class, 'index'])->middleware('auth');
Route::add('POST', '/accruals/store', [AccrualController::class, 'store'])->middleware('auth');

Route::add('GET', '/deductions', [DeductionController::class, 'index'])->middleware('auth');
Route::add('POST', '/deductions/store', [DeductionController::class, 'store'])->middleware('auth');

Route::add('GET', '/payslip', [PayslipController::class, 'index'])->middleware('auth');
Route::add('POST', '/payslip/generate', [PayslipController::class, 'generate'])->middleware('auth');

Route::add('GET', '/admin/employee/add', [AdminController::class, 'addEmployee'])->middleware('auth');
Route::add('POST', '/admin/employee/store', [AdminController::class, 'storeEmployee'])->middleware('auth');
Route::add('GET', '/admin/user/add', [AdminController::class, 'addUser'])->middleware('auth');
Route::add('POST', '/admin/user/store', [AdminController::class, 'storeUser'])->middleware('auth');
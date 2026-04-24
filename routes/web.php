<?php

use Src\Route;
use Controller\Site;
use Controller\UserController;
use Controller\EmployeeController;
use Controller\TransactionController;
use Controller\PayslipController;
use Controller\AdminController;

Route::add(['GET', 'POST'], '/', [UserController::class, 'login']);
Route::add('GET', '/logout', [UserController::class, 'logout']);

Route::add('GET', '/dashboard', [EmployeeController::class, 'dashboard'])->middleware('auth');
Route::add('GET', '/employee/{id}', [EmployeeController::class, 'employee'])->middleware('auth');

Route::add('GET', '/transactions', [TransactionController::class, 'index'])->middleware('auth');
Route::add('POST', '/transactions/add-accrual', [TransactionController::class, 'addAccrual'])->middleware('auth');
Route::add('POST', '/transactions/add-deduction', [TransactionController::class, 'addDeduction'])->middleware('auth');

Route::add('GET', '/permanent-deductions', [TransactionController::class, 'permanentDeductions'])->middleware('auth');
Route::add('POST', '/permanent-deductions/store', [TransactionController::class, 'storePermanentDeduction'])->middleware('auth');

Route::add(['GET', 'POST'], '/payslip', [PayslipController::class, 'index'])->middleware('auth');

Route::add('GET', '/admin/employee/add', [AdminController::class, 'addEmployee'])->middleware('auth');
Route::add('POST', '/admin/employee/store', [AdminController::class, 'storeEmployee'])->middleware('auth');
Route::add('GET', '/admin/user/add', [AdminController::class, 'addUser'])->middleware('auth');
Route::add('POST', '/admin/user/store', [AdminController::class, 'storeUser'])->middleware('auth');
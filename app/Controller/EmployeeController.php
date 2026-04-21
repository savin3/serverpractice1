<?php

namespace Controller;

use Src\View;
use Model\Employee;

class EmployeeController
{
    public function dashboard(): string
    {
        $employees = Employee::all();
        return (new View())->render('site.dashboard', ['employees' => $employees]);
    }

    public function employee(int $id): string
    {
        $employee = Employee::findOrFail($id);
        return (new View())->render('site.employee', ['employee' => $employee]);
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
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
        $accruals = $employee->accruals;
        return (new View())->render('site.employee_accruals', [
            'employee' => $employee,
            'accruals' => $accruals
        ]);
    }

    public function employeeDeductions(int $id): string
    {
        $employee = Employee::findOrFail($id);
        $transactions = $employee->transactions;
        $deductions = [];
        foreach ($transactions as $transaction) {
            if ($transaction->deduction) {
                $deductions[] = $transaction->deduction;
            }
        }
        return (new View())->render('site.employee_deductions', [
            'employee' => $employee,
            'deductions' => $deductions
        ]);
    }

    public function employeePayslips(int $id): string
    {
        $employee = Employee::findOrFail($id);
        $transactions = $employee->transactions;
        $payslips = [];
        foreach ($transactions as $transaction) {
            foreach ($transaction->payslips as $payslip) {
                $payslips[] = $payslip;
            }
        }
        return (new View())->render('site.employee_payslips', [
            'employee' => $employee,
            'payslips' => $payslips
        ]);
    }
}
<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Employee;
use Model\Accrual;
use Model\Transaction;
use Model\Payslip;


class PayslipController
{
    public function index(Request $request): string
    {
        $employees = Employee::all();

        $months = [
            '1' => 'Январь', '2' => 'Февраль', '3' => 'Март', '4' => 'Апрель',
            '5' => 'Май', '6' => 'Июнь', '7' => 'Июль', '8' => 'Август',
            '9' => 'Сентябрь', '10' => 'Октябрь', '11' => 'Ноябрь', '12' => 'Декабрь'
        ];

        $departments = Employee::getDepartmentTypes();

        $payslip = null;
        $report = null;

        if ($request->method === 'POST') {
            if ($request->action === 'payslip') {
                $payslip = $this->generatePayslip($request);
            } elseif ($request->action === 'report') {
                $report = $this->generateReport($request);
            }
        }

        return (new View())->render('site.payslip', [
            'employees' => $employees,
            'months' => $months,
            'departments' => $departments,
            'payslip' => $payslip,
            'report' => $report
        ]);
    }

    private function generatePayslip($request): array
    {
        $employeeId = $request->employee_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $employee = Employee::find($employeeId);
        $totalAccruals = Accrual::getTotalByEmployeeAndPeriod($employeeId, $startDate, $endDate);
        $totalDeductions = Transaction::getTotalDeductionsByEmployeeAndPeriod($employeeId, $startDate, $endDate);

        return [
            'employee' => $employee,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_accruals' => $totalAccruals,
            'total_deductions' => $totalDeductions,
            'amount_to_pay' => $totalAccruals - $totalDeductions
        ];
    }

    private function generateReport($request): array
    {
        $month = $request->report_month;
        $year = $request->report_year;
        $department = $request->report_department ?? '';

        $startDate = "$year-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));

        $results = Accrual::getAverageSalaryByDepartment($startDate, $endDate, $department);

        return [
            'month' => $month,
            'year' => $year,
            'department' => $department,
            'data' => $results
        ];
    }
}
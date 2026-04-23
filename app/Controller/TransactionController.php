<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Employee;
use Model\Accrual;
use Model\Deduction;
use Model\Transaction;

class TransactionController
{
    public function index(): string
    {
        $employees = Employee::all();
        $accruals = Accrual::with('employee')->get();
        $transactions = Transaction::with('accrual.employee', 'deduction')->get();

        $accrualTypes = Accrual::getTypes();
        $deductionTypes = Deduction::getTypes();

        $months = [
            '1' => 'Январь', '2' => 'Февраль', '3' => 'Март', '4' => 'Апрель',
            '5' => 'Май', '6' => 'Июнь', '7' => 'Июль', '8' => 'Август',
            '9' => 'Сентябрь', '10' => 'Октябрь', '11' => 'Ноябрь', '12' => 'Декабрь'
        ];

        return (new View())->render('site.transactions', [
            'employees' => $employees,
            'accruals' => $accruals,
            'transactions' => $transactions,
            'accrualTypes' => $accrualTypes,
            'deductionTypes' => $deductionTypes,
            'months' => $months
        ]);
    }

    public function addAccrual(Request $request): void
    {
        $accrual = Accrual::create($request->all());
        Transaction::create([
            'accrual_id' => $accrual->id,
            'amount' => $request->amount,
            'date_transaction' => $request->date_of_accrual
        ]);
        app()->route->redirect('/transactions');
    }

    public function addDeduction(Request $request): void
    {
        $accrual = Accrual::find($request->accrual_id);
        $deduction = Deduction::create($request->all());
        Transaction::create([
            'accrual_id' => $accrual->id,
            'deduction_id' => $deduction->id,
            'amount' => $request->amount,
            'date_transaction' => $request->date_of_deduction,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
        app()->route->redirect('/transactions');
    }
}
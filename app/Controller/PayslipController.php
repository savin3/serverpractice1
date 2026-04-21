<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Transaction;
use Model\Payslip;

class PayslipController
{
    public function index(): string
    {
        return (new View())->render('site.payslip');
    }
    
    public function generate(Request $request): void
    {
        $transactionId = $request->get('transaction_id');
        $userId = app()->auth->user()->id;

        Payslip::create([
            'transaction_id' => $transactionId,
            'user_id' => $userId
        ]);

        app()->route->redirect('/payslip');
    }
}
<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Accrual;

class AccrualController
{
    public function index(): string
    {
        $accruals = Accrual::with('employee')->get();
        return (new View())->render('site.accruals', ['accruals' => $accruals]);
    }

    public function store(Request $request): void
    {
        $data = $request->all();
        Accrual::create($data);
        app()->route->redirect('/accruals');
    }
}
<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Deduction;

class DeductionController
{
    public function index(): string
    {
        $deductions = Deduction::all();
        return (new View())->render('site.deductions', ['deductions' => $deductions]);
    }

    public function store(Request $request): void
    {
        $data = $request->all();
        Deduction::create($data);
        app()->route->redirect('/deductions');
    }
}
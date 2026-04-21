<?php

namespace Controller;

use Src\View;

class AccrualController
{
    public function index(): string
    {
        return (new View())->render('site.accruals');
    }
}
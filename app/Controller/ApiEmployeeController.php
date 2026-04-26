<?php

namespace Controller;

use Model\Employee;
use Src\View;

class ApiEmployeeController
{
    private function getUser()
    {
        return $GLOBALS['api_user'] ?? null;
    }

    public function index(): void
    {
        if (!$this->getUser()) {
            (new View())->toJSON(['error' => 'Unauthorized'], 401);
            return;
        }

        $employees = Employee::all()->toArray();
        (new View())->toJSON($employees);
    }

    public function show(int $id): void
    {
        if (!$this->getUser()) {
            (new View())->toJSON(['error' => 'Unauthorized'], 401);
            return;
        }

        $employee = Employee::find($id);
        if (!$employee) {
            (new View())->toJSON(['error' => 'Employee not found'], 404);
            return;
        }

        (new View())->toJSON($employee->toArray());
    }
}
<?php

namespace Controller;

use Src\Request;
use Src\View;
use Model\Employee;

class EmployeeController
{
    public function dashboard(Request $request): string
    {
        $search = $request->get('search', '');

        $query = Employee::query();

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('last_name', 'like', "%$search%")
                    ->orWhere('first_name', 'like', "%$search%")
                    ->orWhere('employee_number', 'like', "%$search%");
            });
        }

        $employees = $query->get();
        return (new View())->render('site.dashboard', ['employees' => $employees]);
    }

    public function employee(int $id): string
    {
        $employee = Employee::findOrFail($id);
        return (new View())->render('site.employee', ['employee' => $employee]);
    }
}
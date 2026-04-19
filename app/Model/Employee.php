<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'payer_number',
        'employee_number',
        'insurance_number',
        'bank_account',
        'date_employment',
        'bonus'
    ];

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'employeeposition');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'employeedepartment');
    }

    public function accruals()
    {
        return $this->hasMany(Accrual::class);
    }

    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }
}
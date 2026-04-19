<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDepartment extends Model
{
    use HasFactory;
    protected $table = 'employeeedepartment';
    public $timestamps = false;

    protected $fillable = ['employee_id', 'department_id'];
}
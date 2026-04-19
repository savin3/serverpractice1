<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    use HasFactory;
    protected $table = 'employeeposition';
    public $timestamps = false;

    protected $fillable = ['employee_id', 'position_id'];
}
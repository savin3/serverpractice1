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
        'position',
        'department',
        'bonus',
        'salary'
    ];

    public function accruals()
    {
        return $this->hasMany(Accrual::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Accrual::class);
    }
}
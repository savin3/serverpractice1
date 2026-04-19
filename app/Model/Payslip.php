<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;
    const UPDATED_AT = null;

    protected $fillable = [
        'employee_id',
        'user_id',
        'start_date',
        'end_date',
        'total_accruals',
        'total_deductions',
        'amount_to_pay'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
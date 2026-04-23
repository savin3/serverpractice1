<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'deduction_id',
        'accrual_id',
        'amount',
        'start_date',
        'end_date',
        'date_transaction'
    ];

    public function accrual()
    {
        return $this->belongsTo(Accrual::class);
    }

    public function deduction()
    {
        return $this->belongsTo(Deduction::class);
    }

    public static function getPermanentDeductions()
    {
        return self::with('deduction', 'accrual.employee')
            ->whereNotNull('start_date')
            ->get();
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }

    public static function getTotalDeductionsByEmployeeAndPeriod($employeeId, $startDate, $endDate)
    {
        return self::whereHas('accrual', function($q) use ($employeeId, $startDate, $endDate) {
            $q->where('employee_id', $employeeId)
                ->whereBetween('date_of_accrual', [$startDate, $endDate]);
        })
            ->whereNotNull('deduction_id')
            ->where(function($q) use ($startDate, $endDate) {
                $q->whereNull('start_date')
                    ->orWhere(function($q2) use ($startDate, $endDate) {
                        $q2->where('start_date', '<=', $endDate)
                            ->where(function($q3) use ($startDate) {
                                $q3->whereNull('end_date')
                                    ->orWhere('end_date', '>=', $startDate);
                            });
                    });
            })
            ->sum('amount');
    }
}
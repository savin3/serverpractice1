<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accrual extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'amount',
        'month',
        'employee_id',
        'accrual_type',
        'date_of_accrual'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function getTypes()
    {
        $connection = \Illuminate\Database\Capsule\Manager::connection();
        $raw = $connection->select("SHOW COLUMNS FROM accruals WHERE Field = 'accrual_type'");
        if (empty($raw)) {
            return [];
        }
        $enumStr = $raw[0]->Type;
        preg_match_all("/'([^']+)'/", $enumStr, $matches);
        return $matches[1];
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public static function getTotalByEmployeeAndPeriod($employeeId, $startDate, $endDate)
    {
        return self::where('employee_id', $employeeId)
            ->whereBetween('date_of_accrual', [$startDate, $endDate])
            ->sum('amount');
    }

    public static function getAverageSalaryByDepartment($startDate, $endDate, $department = null)
    {
        $query = self::join('employees', 'accruals.employee_id', '=', 'employees.id')
            ->select('employees.department', \Illuminate\Database\Capsule\Manager::raw('AVG(accruals.amount) as avg_salary'))
            ->whereBetween('accruals.date_of_accrual', [$startDate, $endDate]);

        if (!empty($department)) {
            $query->where('employees.department', $department);
        }

        return $query->groupBy('employees.department')->get();
    }
}
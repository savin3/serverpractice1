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
}
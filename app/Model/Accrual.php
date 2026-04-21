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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
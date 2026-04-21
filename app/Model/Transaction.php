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

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }
}
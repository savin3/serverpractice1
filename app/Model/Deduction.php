<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'amount',
        'month',
        'deduction_type_id',
        'date_of_deduction',
        'comment',
        'start_date',
        'end_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function type()
    {
        return $this->belongsTo(DeductionType::class, 'deduction_type_id');
    }
}
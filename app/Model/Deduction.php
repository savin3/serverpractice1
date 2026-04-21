<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'amount',
        'month',
        'deduction_type',
        'date_of_deduction',
        'comment'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
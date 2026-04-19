<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccrualType extends Model
{
    use HasFactory;
    protected $table = 'accrualtypes';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function accruals()
    {
        return $this->hasMany(Accrual::class);
    }
}
<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name', 'salary'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employeeposition');
    }
}
<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employeedepartment');
    }
}
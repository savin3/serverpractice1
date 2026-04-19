<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'userrole';
    public $timestamps = false;

    protected $fillable = ['user_id', 'role_id'];
}
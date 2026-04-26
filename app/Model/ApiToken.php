<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'token'];
    protected $table = 'api_tokens';
}
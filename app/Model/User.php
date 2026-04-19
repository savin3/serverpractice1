<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    const UPDATED_AT = null;
    protected $fillable = [
        'login',
        'password'
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->password = md5($user->password);
            $user->save();
        });
    }

    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function attemptIdentity(array $credentials)
    {
        return self::where(['login' => $credentials['login'],
            'password' => md5($credentials['password'])])->first();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'userrole');
    }

    public function isAdmin()
    {
        return $this->roles->contains('name', 'admin');
    }

    public function isAccountant()
    {
        return $this->roles->contains('name', 'accountant');
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }
}
<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;
    protected $table = 'users';

    public $timestamps = false;
    protected $fillable = [
        'id',
        'login',
        'name',
        'surname',
        'patronymic',
        'role_id',
        'password',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->password = md5($user->password);
            $user->save();
        });
    }

    //Выборка пользователя по первичному ключу
    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    //Возврат первичного ключа
    public function getId(): int
    {
        return $this->id;
    }

    //Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where(['login' => $credentials['login'],
            'password' => md5($credentials['password'])])->first();
    }

    public function isAdmin(): bool
    {
        return Role::find($this->role_id)->name == 'Admin';
    }
    public function getRole(): string
    {
        return Role::find($this->role_id)->name;
    }

}

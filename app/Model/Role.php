<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    //Выборка роли по первичному ключу
    public static function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }
}

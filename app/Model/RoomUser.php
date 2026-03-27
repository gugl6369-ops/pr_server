<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class RoomUser extends Model
{
    protected $table = 'room_user';
    public $timestamps = false;

    protected $fillable = [
        'room_id',
        'id_login'
    ];
}

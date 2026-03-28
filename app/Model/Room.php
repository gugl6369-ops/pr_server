<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class Room extends Model
{
    protected $table = 'room'; // имя таблицы

    public $timestamps = false;

    protected $fillable = [
        'number',
        'square',
        'seating',
        'building_id',
        'view_id'
    ];


    public function delete(): bool
    {
        Capsule::table('room_user')
            ->where('room_id', $this->id)
            ->delete();

        return Capsule::table('rooms')
            ->where('id', $this->id)
            ->delete();
    }
}

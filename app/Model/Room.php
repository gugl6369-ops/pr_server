<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

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
}

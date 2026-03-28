<?php

namespace Model;
use Model\Room;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'building';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'address'
    ];
    public function canDelete(): bool
    {
        return !Room::where('building_id', $this->id)->exists();
    }

    public function getStats(): array
    {
        $rooms = Room::where('building_id', $this->id)->get();

        $totalSquare = 0;
        $totalSeating = 0;

        foreach ($rooms as $room) {
            $totalSquare += $room->square;
            $totalSeating += $room->seating;
        }

        return [
            'square' => $totalSquare,
            'seating' => $totalSeating
        ];
    }
}
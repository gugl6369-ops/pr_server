<?php

namespace Controller;

use Model\Building;
use Model\Post;
use Model\Room;
use Model\User;
use BasicValidators\Validator\Validator;
use Src\Request;
use Src\View;

class Api
{
    public function index(): void
    {
        $usser = User::all()->toArray();

        (new View())->toJSON($usser);
    }

    public function echo(Request $request): void
    {
        (new View())->toJSON($request->all());
    }

    public function login(Request $request): void
    {
        $login = $request->get('login');
        $password = $request->get('password');

        if (!$login || !$password) {
            (new View())->toJSON(['error' => 'Логин и пароль обязательны'], 400);
            return;
        }

        $user = User::where('login', $login)
            ->where('password', md5($password))
            ->first();

        if (!$user) {
            (new View())->toJSON(['error' => 'Логин или пароль неправильный'], 401);
            return;
        }

        $token = bin2hex(random_bytes(32));
        $user->token = $token;
        $user->save();

        (new View())->toJSON(['token' => $token]);
    }

    public function createRoom(Request $request): void
    {
        $validator = new Validator($request->all(), [
            'number' => ['required', 'max:5', 'numeric'],
            'square' => ['required', 'numeric'],
            'seating' => ['required', 'integer'],
            'building_id' => ['required'],
            'view_id' => ['required'],
        ], [
            'required' => 'Поле :field пусто',
        ]);

        if ($validator->fails()) {
            (new View())->toJSON(['errors' => $validator->errors()], 422);
        }

        $room = Room::create([
            'number' => $request->get('number'),
            'square' => $request->get('square'),
            'seating' => $request->get('seating'),
            'building_id' => $request->get('building_id'),
            'view_id' => $request->get('view_id'),
        ]);

        (new View())->toJSON([
            'message' => 'Комната создана',
            'room' => $room->toArray(),
        ], 201);
    }

    public function createBuilding(Request $request): void
    {
        $validator = new Validator($request->all(), [
            'name' => ['required', 'max:50', 'min:3'],
            'address' => ['required', 'min:3'],
        ], [
            'required' => 'Поле :field пусто',
        ]);

        if ($validator->fails()) {
            (new View())->toJSON(['errors' => $validator->errors()], 422);
        }

        $building = Building::create([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
        ]);

        (new View())->toJSON([
            'message' => 'Здание создано',
            'building' => $building->toArray(),
        ], 201);
    }
}

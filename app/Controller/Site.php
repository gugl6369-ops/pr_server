<?php

namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;
use Model\Room;
use Model\Building;
use Model\RoomView;
use Model\RoomUser;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }


    public function hello(): string
    {
        $users = User::all();

        $userId = Auth::user()['id'];

        // 👉 получаем комнаты через join
        $rooms = Room::join('room_user', 'room.id', '=', 'room_user.room_id')
            ->where('room_user.id_login', $userId)
            ->get();



        return new View('site.hello', ['message' => 'hello working', 'users' => $users, 'rooms' => $rooms]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'surname' => ['required'],
                'password' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            else {
                User::create(array_merge($request->all(), ['role_id' => 2]));
                app()->route->redirect('/hello');
            }
        }
        return new View('site.signup');
    }


    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function deleteUser(Request $request): void
    {
        if (!Auth::check()) {
            app()->route->redirect('/hello');
            return;
        }


        $currentUser = User::find(Auth::user()['id']);

        if (!$currentUser || !$currentUser->isAdmin()) {
            app()->route->redirect('/hello');
            return;
        }

        $id = $request->id;

        if (!$id) {
            app()->route->redirect('/hello');
            return;
        }

        $user = User::where('id', $id)->first();

        if (!$user) {
            app()->route->redirect('/hello');
            return;
        }

        // нельзя удалить себя
        if ($user->id == $currentUser->id) {
            app()->route->redirect('/hello');
            return;
        }

        $user->delete();

        app()->route->redirect('/hello');
    }

    public function editUser(Request $request): string
    {
        if (!Auth::check()) {
            app()->route->redirect('/hello');
            return '';
        }

        $currentUser = User::find(Auth::user()['id']);

        if (!$currentUser || !$currentUser->isAdmin()) {
            app()->route->redirect('/hello');
            return '';
        }

        $id = $request->id;

        if (!$id) {
            app()->route->redirect('/hello');
            return '';
        }

        $user = User::find($id);

        if (!$user) {
            app()->route->redirect('/hello');
            return '';
        }

        if ($request->method === 'POST') {

            $user->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'patronymic' => $request->patronymic,
                'login' => $request->login,
                'role_id' => $request->role_id,
            ]);

            app()->route->redirect('/hello');
        }

        return (new View())->render('site.user-edit', [
            'user' => $user
        ]);
    }




    public function rooms(): string
    {
        $rooms = Room::all();
        $buildings = Building::all();
        $views = RoomView::all();

        return (new View())->render('site.rooms', [
            'rooms' => $rooms,
            'buildings' => $buildings,
            'views' => $views
        ]);
    }

    public function deleteRoom(Request $request): void
    {
        // только сотрудник (role_id = 2)
        if (!Auth::check() || Auth::user()['role_id'] != 2) {
            app()->route->redirect('/rooms');
            return;
        }

        $id = $request->id;

        if (!$id) {
            app()->route->redirect('/rooms');
            return;
        }

        $room = Room::find($id);

        if (!$room) {
            app()->route->redirect('/rooms');
            return;
        }

        $room->delete();

        app()->route->redirect('/rooms');
    }

    public function editRoom(Request $request): string
    {
        if (!Auth::check() || Auth::user()['role_id'] != 2) {
            app()->route->redirect('/rooms');
            return '';
        }

        $room = Room::find($request->id);

        $buildings = Building::all();
        $views = RoomView::all();

        if (strtoupper($request->method) === 'POST') {

            $room->update([
                'number' => $request->number,
                'square' => $request->square,
                'seating' => $request->seating,
                'building_id' => $request->building_id,
                'view_id' => $request->view_id,
            ]);

            app()->route->redirect('/rooms');
        }

        return (new \Src\View())->render('site.room-edit', [
            'room' => $room,
            'buildings' => $buildings,
            'views' => $views
        ]);
    }

    public function createRoom(Request $request): string
    {
        if (!Auth::check() || Auth::user()['role_id'] != 2) {
            app()->route->redirect('/rooms');
            return '';
        }

        $buildings = Building::all();
        $views = RoomView::all();

        if (strtoupper($request->method) === 'POST') {

            $room = Room::create([
                'number' => $request->number,
                'square' => $request->square,
                'seating' => $request->seating,
                'building_id' => $request->building_id,
                'view_id' => $request->view_id,
            ]);

            app()->route->redirect('/rooms');
        }

        return (new \Src\View())->render('site.room-create', [
            'buildings' => $buildings,
            'views' => $views
        ]);
    }

    public function attachRoom(Request $request): void
    {
        if (!Auth::check()) {
            app()->route->redirect('/login');
            return;
        }

        $roomId = $request->id;

        if (!$roomId) {
            app()->route->redirect('/rooms');
            return;
        }

        $exists = RoomUser::where([
            'room_id' => $roomId,
            'id_login' => Auth::user()['id']
        ])->first();

        if (!$exists) {
            RoomUser::create([
                'room_id' => $roomId,
                'id_login' => Auth::user()['id']
            ]);
        }

        app()->route->redirect('/hello');
    }






}

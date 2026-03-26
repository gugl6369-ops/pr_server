<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup'])
    ->middleware('auth', 'admin');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/delete-user', [Controller\Site::class, 'deleteUser'])
    ->middleware('auth', 'admin');
Route::add('GET', '/edit-user', [Controller\Site::class, 'editUser'])
    ->middleware('auth', 'admin');
Route::add('POST', '/edit-user', [Controller\Site::class, 'editUser'])
    ->middleware('auth', 'admin');
Route::add('GET', '/rooms', [Controller\Site::class, 'rooms'])
    ->middleware('auth');
Route::add('GET', '/delete-room', [Controller\Site::class, 'deleteRoom'])
    ->middleware('auth');;


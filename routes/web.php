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
    ->middleware('auth');
Route::add('GET', '/edit-room', [Controller\Site::class, 'editRoom'])
    ->middleware('auth');
Route::add('POST', '/edit-room', [Controller\Site::class, 'editRoom'])
    ->middleware('auth');
Route::add('GET', '/create-room', [Controller\Site::class, 'createRoom'])
    ->middleware('auth');;
Route::add('POST', '/create-room', [Controller\Site::class, 'createRoom'])
    ->middleware('auth');
Route::add('GET', '/attach-room', [Controller\Site::class, 'attachRoom'])
    ->middleware('auth');
Route::add('GET', '/detach-room', [Controller\Site::class, 'detachRoom'])
    ->middleware('auth');
Route::add('GET', '/buildings', [Controller\Site::class, 'buildings'])
    ->middleware('auth');
Route::add('GET', '/delete-building', [Controller\Site::class, 'deleteBuilding'])
    ->middleware('auth');
Route::add('GET', '/building-create', [Controller\Site::class, 'createBuilding'])
    ->middleware('auth');
Route::add('POST', '/building-create', [Controller\Site::class, 'createBuilding'])
    ->middleware('auth');
Route::add('GET', '/building-edit', [Controller\Site::class, 'editBuilding'])
    ->middleware('auth');
Route::add('POST', '/building-edit', [Controller\Site::class, 'editBuilding'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/upload-bg', [Controller\Site::class, 'uploadBackground'])
    ->middleware('auth');




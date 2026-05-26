<?php


use Src\Route;

Route::add('GET', '', [Controller\Api::class, 'index'])->middleware('token');
Route::add('POST', '/echo', [Controller\Api::class, 'echo']);
Route::add('POST', '/login', [Controller\Api::class, 'login']);
Route::add('POST', '/rooms', [Controller\Api::class, 'createRoom'])->middleware('token');
Route::add('POST', '/buildings', [Controller\Api::class, 'createBuilding'])->middleware('token');
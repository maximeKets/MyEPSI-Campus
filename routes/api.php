<?php

use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('floors', FloorController::class);
Route::apiResource('rooms', RoomController::class);
Route::apiResource('infos', InfoController::class);

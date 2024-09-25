<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('floors', FloorController::class);
Route::apiResource('rooms', RoomController::class);
Route::apiResource('infos', InfoController::class);
Route::apiResource('courses', CourseController::class);

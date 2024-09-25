<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use  \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return RoomResource::collection(Room::with('infos', 'courses')->get());
    }


    public function show(Room $room) : RoomResource
    {
        return new RoomResource($room->load('infos, courses'));
    }
}

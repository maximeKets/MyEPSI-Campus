<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\FloorResource;
use App\Models\Floor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FloorController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return FloorResource::collection(Floor::with('rooms.infos')->get());
    }

    public function show(Floor $floor) : FloorResource
    {
        return new FloorResource($floor->load('rooms.infos'));
    }
}

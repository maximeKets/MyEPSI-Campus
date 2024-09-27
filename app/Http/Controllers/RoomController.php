<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Services\SchemaService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $schemaService;
    protected $routeName = 'rooms';

    public function __construct(SchemaService $schemaService)
    {
        $this->schemaService = $schemaService;
    }

    public function index()
    {
        $items = Room::all();
        $columns = (new Room)->getFillable();
        $routeName = $this->routeName;
        return view('crud.index', compact('items', 'routeName', 'columns'));
    }

    public function create()
    {
        return $this->formView();
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        Room::create($validated);
        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        return $this->formView($room);
    }

    public function update(Request $request, Room $room)
    {
        $validated = $this->validateRequest($request, $room);
        $room->update($validated);
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }

    private function formView(Room $room = null)
    {
        $columns = (new Room)->getFillable();
        $inputTypes = $this->schemaService->getColumnTypes('rooms');
        $routeName = $this->routeName;
        $item = $room;
        return view('crud.form', compact('item',  'routeName', 'columns', 'inputTypes'));
    }

    private function validateRequest(Request $request, Room $room = null)
    {

     $roomNumber = $room ? $room->id : "NULL";

        return $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer|unique:rooms,number, ' . $roomNumber,
            'description' => 'required|string|max:255',
            'is_available' => 'required|boolean',
            'floor_id' => 'required|exists:floors,id',
        ]);
    }
}

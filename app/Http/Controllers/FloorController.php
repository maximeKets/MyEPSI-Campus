<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Services\SchemaService;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    protected $schemaService;
    protected $modelName = 'Etage';
    protected $routeName = 'floors';

    public function __construct(SchemaService $schemaService)
    {
        $this->schemaService = $schemaService;
    }

    public function index()
    {
        $items = Floor::all();
        $columns = (new Floor)->getFillable();
        $modelName = $this->modelName;
        $routeName = $this->routeName;
        return view('crud.index', compact('items', 'modelName', 'routeName', 'columns'));
    }

    public function create()
    {
        return $this->formView();
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        Floor::create($validated);
        return redirect()->route('floors.index')->with('success', 'Floor created successfully.');
    }

    public function edit(Floor $floor)
    {
        return $this->formView($floor);
    }

    public function update(Request $request, Floor $floor)
    {
        $validated = $this->validateRequest($request, $floor);
        $floor->update($validated);
        return redirect()->route('floors.index')->with('success', 'Floor updated successfully.');
    }

    public function destroy(Floor $floor)
    {
        $floor->delete();
        return redirect()->route('floors.index')->with('success', 'Floor deleted successfully.');
    }

    private function formView(Floor $floor = null)
    {
        $columns = (new Floor)->getFillable();
        $inputTypes = $this->schemaService->getColumnTypes('floors');
        $modelName = $this->modelName;
        $routeName = $this->routeName;
        $item = $floor;
        return view('crud.form', compact('item', 'modelName', 'routeName', 'columns', 'inputTypes'));
    }

    private function validateRequest(Request $request, Floor $floor = null)
    {
        $floorId = $floor ? $floor->id : 'NULL';  // S'assurer que l'ID est bien géré, même s'il est nul

        return $request->validate([
            'number' => 'required|integer|unique:floors,number,' . $floorId,
            'description' => 'required|string|max:255',
            'is_available' => 'required|boolean',
        ]);
    }
}

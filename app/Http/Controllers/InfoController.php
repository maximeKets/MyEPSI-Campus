<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Services\SchemaService;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    protected $schemaService;
    protected $modelName = 'Info';
    protected $routeName = 'infos';

    public function __construct(SchemaService $schemaService)
    {
        $this->schemaService = $schemaService;
    }

    public function index()
    {
        $items = Info::all();
        $columns = (new Info)->getFillable();
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
        Info::create($validated);
        return redirect()->route('infos.index')->with('success', 'Info created successfully.');
    }

    public function edit(Info $info)
    {
        return $this->formView($info);
    }

    public function update(Request $request, Info $info)
    {
        $validated = $this->validateRequest($request);
        $info->update($validated);
        return redirect()->route('infos.index')->with('success', 'Info updated successfully.');
    }

    public function destroy(Info $info)
    {
        $info->delete();
        return redirect()->route('infos.index')->with('success', 'Info deleted successfully.');
    }

    private function formView(Info $info = null)
    {
        $columns = (new Info)->getFillable();
        $inputTypes = $this->schemaService->getColumnTypes('infos');
        $modelName = $this->modelName;
        $routeName = $this->routeName;
        $item = $info;
        return view('crud.form', compact('item', 'modelName', 'routeName', 'columns', 'inputTypes'));
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'room_id' => 'required|exists:rooms,id',
        ]);
    }
}

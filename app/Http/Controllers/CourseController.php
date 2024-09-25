<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\SchemaService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $schemaService;
    protected $modelName = 'Course';
    protected $routeName = 'courses';

    public function __construct(SchemaService $schemaService)
    {
        $this->schemaService = $schemaService;
    }

    public function index()
    {
        $items = Course::all();
        $columns = (new Course)->getFillable();
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
        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        return $this->formView($course);
    }

    public function update(Request $request, Course $course)
    {
        $validated = $this->validateRequest($request);
        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    private function formView(Course $course = null)
    {
        $columns = (new Course)->getFillable();
        $inputTypes = $this->schemaService->getColumnTypes('courses');
        $modelName = $this->modelName;
        $routeName = $this->routeName;
        $item = $course;
        return view('crud.form', compact('item', 'modelName', 'routeName', 'columns', 'inputTypes'));
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'teacher' => 'required|string|max:255',
            'date' => 'required|date',
            'promotion' => 'required|string|max:255',
            'start_hours' => 'required|date_format:H:i',
            'end_hours' => 'required|date_format:H:i',
            'room_id' => 'required|exists:rooms,id',
        ]);
    }
}

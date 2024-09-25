<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course; // Import the Course model

class CourseController extends Controller
{
    // app/Http/Controllers/Api/CourseController.php

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'teacher' => 'required|string|max:255',
            'date' => 'required|date',
            'promotion' => 'required|string|max:255',
            'start_hours' => 'required|date_format:H:i',
            'end_hours' => 'required|date_format:H:i',
            'room_id' => 'required|exists:rooms,id',
        ]);

        // Create a new course using the validated data
        $course = Course::create($validatedData);

        // Return the created course with a 201 status code (created)
        return response()->json($course, 201);
    }

    public function update(Request $request, string $id)
    {
        // Find the course by ID or return a 404 if not found
        $course = Course::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'teacher' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date',
            'promotion' => 'sometimes|required|string|max:255',
            'start_hours' => 'sometimes|required|date_format:H:i',
            'end_hours' => 'sometimes|required|date_format:H:i',
            'room_id' => 'sometimes|required|exists:rooms,id',
        ]);

        // Update the course with the validated data
        $course->update($validatedData);

        // Return the updated course data
        return response()->json($course, 200);
    }
}

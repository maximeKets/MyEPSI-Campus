<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate courses for the week using the factory's `forWeek()` method
        $courses = Course::factory()->forWeek();

        // Insert the courses into the database
        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}

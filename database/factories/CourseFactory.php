<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    protected $jeux_de_mots = [
        "Rémi Fasol", "Paul Ochon", "Laurent Houtan", "Justin Ptipeu",
        "Jean Bonboeur", "Jacques Sonne", "Alex Térieur", "Léo Garage",
        "Alban Bou", "Harry Cover", "Firmin Peutabouche", "Vincent Times",
        "Abel Auboisdorman", "Adam Quelquesjours", "Brice Glace",
        "Eddy Donçavapaslatête", "Gérard Issime", "Yves Vapabien",
        "Alfonse Danlta", "Omer Dalors"
    ];

    protected $promotions = [
        "DEV IA", "DEV FULLSTACK", "RESEAUX", "MARKETING",
    ];

    protected $course_titles = [
        "Advanced Programming", "AI Foundations", "Network Security", "Data Science",
        "Marketing Strategies", "Cloud Computing", "Project Management", "Software Design",
        "DevOps Essentials", "Database Systems", "Ethical Hacking", "Mobile App Development",
        "Cybersecurity Basics", "Agile Methodologies", "Web Development",
    ];

    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement($this->course_titles),
            'teacher' => $this->faker->randomElement($this->jeux_de_mots),
            'date' => Carbon::now()->format('Y-m-d'),  // Placeholder date
            'promotion' => $this->faker->randomElement($this->promotions),  // Placeholder promotion
            'start_hours' => '09:00',  // Placeholder time
            'end_hours' => '13:00',    // Placeholder time
            'room_id' => Room::inRandomOrder()->first()->id,
        ];
    }

    public function forWeek(): array
    {
        $week = [];
        foreach ($this->promotions as $promotion) {
            for ($i = 0; $i < 5; $i++) {  // Monday to Friday
                $day = Carbon::now()->startOfWeek()->addDays($i);

                // First course: 9:00 to 13:00
                $week[] = [
                    'title' => $this->faker->randomElement($this->course_titles),
                    'teacher' => $this->faker->randomElement($this->jeux_de_mots),
                    'date' => $day->format('Y-m-d'),
                    'promotion' => $promotion,
                    'start_hours' => '09:00',
                    'end_hours' => '13:00',
                    'room_id' => Room::inRandomOrder()->first()->id,
                ];

                // Second course: 14:00 to 17:00
                $week[] = [
                    'title' => $this->faker->randomElement($this->course_titles),
                    'teacher' => $this->faker->randomElement($this->jeux_de_mots),
                    'date' => $day->format('Y-m-d'),
                    'promotion' => $promotion,
                    'start_hours' => '14:00',
                    'end_hours' => '17:00',
                    'room_id' => Room::inRandomOrder()->first()->id,
                ];
            }
        }
        return $week;
    }
}

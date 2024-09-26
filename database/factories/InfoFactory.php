<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Info>
 */
class InfoFactory extends Factory
{
    public function definition(): array
    {
        return [
            "content" => null,  // This will be filled depending on the type
            'room_id' => null,  // This will be assigned in the seeder
            'type' => null,  // Type of info (wifi, outlets, or video_conference)
        ];
    }

    /**
     * Define a state for Wi-Fi information.
     */
    public function wifi()
    {
        return $this->state(function () {
            return [
                'type' => 'wifi',
                'content' => $this->faker->boolean(50) ? 'Available' : 'Not available',
            ];
        });
    }

    /**
     * Define a state for available outlets.
     */
    public function outlets()
    {
        return $this->state(function () {
            return [
                'type' => 'available_outlets',
                'content' => $this->faker->numberBetween(0, 5) . ' outlets available',
            ];
        });
    }

    /**
     * Define a state for video conferencing system.
     */
    public function videoConference()
    {
        return $this->state(function () {
            return [
                'type' => 'video_conference_system',
                'content' => $this->faker->boolean(70) ? 'System available' : 'System not available',
            ];
        });
    }
}

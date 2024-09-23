<?php

namespace Database\Factories;

use App\Models\Floor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Floor>
 */
class FloorFactory extends Factory
{
    protected $model = Floor::class;

    private static $floorCounter = 0;

    public function definition()
    {
        $value = self::$floorCounter % 3;
        self::$floorCounter++;

        return [
            'number' => $value,
        ];
    }
}

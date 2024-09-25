<?php

namespace Database\Seeders;

use App\Models\Floor;
use App\Models\Info;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    public function run()
    {
        $floor0 = Floor::factory()->create(['number' => 0]);
        Room::factory()->count(2)->create(['floor_id' => $floor0->id])
            ->each(function ($room) {
                Info::factory()->create(['room_id' => $room->id]);
            });

        $floor1 = Floor::factory()->create(['number' => 1]);
        foreach (range(101, 105) as $roomNumber) {
            $room = Room::factory()->create(['floor_id' => $floor1->id, 'number' => $roomNumber]);
            Info::factory()->create(['room_id' => $room->id]);
        }

        $floor2 = Floor::factory()->create(['number' => 2]);
        foreach (range(201, 205) as $roomNumber) {
            $room = Room::factory()->create(['floor_id' => $floor2->id, 'number' => $roomNumber]);
            Info::factory()->create(['room_id' => $room->id]);
        }
    }
}

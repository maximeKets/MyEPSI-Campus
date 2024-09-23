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
        // Crée 3 étages
        Floor::factory()
            ->count(3)
            ->create()
            ->each(function ($floor) {
                // Pour chaque étage, créer 15 chambres
                Room::factory()
                    ->count(15)
                    ->create(['floor_id' => $floor->id])
                    ->each(function ($room) {
                        // Pour chaque chambre, créer une info
                        Info::factory()->create(['room_id' => $room->id]);
                    });
            });
    }
}

<?php

namespace Database\Seeders;

use App\Models\AcommodationTypes;
use Illuminate\Database\Seeder;

class AcommodationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomsType = ['Cuadruple', 'Triple', 'Doble', 'Sencilla'];
        foreach ($roomsType as $room) {
            AcommodationTypes::insert([ 'name' => $room, 'created_at' => now(), 'updated_at' => now() ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\RoomTypes;
use Illuminate\Database\Seeder;

class RoomTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomsType = ['Estandar', 'Junior', 'Suite'];
        foreach ($roomsType as $room) {
            RoomTypes::insert([ 'name' => $room, 'description' => 'Descripción tipo cuarto '. $room  ]);
        }
    }
}

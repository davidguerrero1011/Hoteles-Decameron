<?php

namespace Database\Seeders;

use App\Models\RoomTypeAccommodation;
use Illuminate\Database\Seeder;

class TypeRoomAccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypeAccommodations = [
            ['roomType' => 1, 'accommodation' => 4],
            ['roomType' => 1, 'accommodation' => 3],
            ['roomType' => 2, 'accommodation' => 2],
            ['roomType' => 2, 'accommodation' => 1],
            ['roomType' => 3, 'accommodation' => 4],
            ['roomType' => 3, 'accommodation' => 3],
            ['roomType' => 3, 'accommodation' => 2]
        ];

        foreach ($roomTypeAccommodations as $type) {
            RoomTypeAccommodation::insert([
                'room_type_id'          => $type['roomType'],
                'accommodation_type_id' => $type['accommodation'],
                'status'                => true,
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
        }
    }
}

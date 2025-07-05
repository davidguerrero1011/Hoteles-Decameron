<?php

namespace Database\Seeders;

use App\Models\AcommodationTypes;
use App\Models\RoomTypeAccommodation;
use App\Models\RoomTypes;
use Illuminate\Database\Seeder;

class TypeRoomAccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $standard = RoomTypes::where('name', 'Estandar')->first();
        $junior = RoomTypes::where('name', 'Junior')->first();
        $suite = RoomTypes::where('name', 'Suite')->first();

        $single = AcommodationTypes::where('name', 'Sencilla')->first();
        $double = AcommodationTypes::where('name', 'Doble')->first();
        $triple = AcommodationTypes::where('name', 'Triple')->first();
        $quadruple = AcommodationTypes::where('name', 'Cuadruple')->first();

        $roomTypeAccommodations = [
            ['roomType' => $standard->id, 'accommodation' => $single->id],
            ['roomType' => $standard->id, 'accommodation' => $double->id],
            ['roomType' => $junior->id, 'accommodation' => $triple->id],
            ['roomType' => $junior->id, 'accommodation' => $quadruple->id],
            ['roomType' => $suite->id, 'accommodation' => $single->id],
            ['roomType' => $suite->id, 'accommodation' => $double->id],
            ['roomType' => $suite->id, 'accommodation' => $triple->id]
        ];

        foreach ($roomTypeAccommodations as $type) {
            RoomTypeAccommodation::insert(['room_type_id' => $type['roomType'], 'accommodation_type_id' => $type['accommodation']]);
        }
    }
}

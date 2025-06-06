<?php

namespace Database\Seeders;

use App\Models\Cities;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = ['Bogota', 'Medellin', 'Cartagena', 'San Andres', 'Cali', 'Pereira', 'Manizales', 'Bucaramanga', 'Cucuta'];
        foreach ($cities as $city) {
            Cities::insert([ 'name' => $city, 'country_id' => 1 ]);
        }
    }
}

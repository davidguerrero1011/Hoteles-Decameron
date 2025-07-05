<?php

namespace Database\Seeders;

use App\Models\Cities;
use App\Models\Countries;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = ['Bogota', 'Medellin', 'Cartagena', 'San Andres', 'Cali', 'Pereira', 'Manizales', 'Bucaramanga', 'Cucuta'];
        $country = Countries::where('name', 'Colombia')->first();

        foreach ($cities as $city) {
            Cities::create(['name' => $city, 'country_id' => $country->id]);
        }
    }
}

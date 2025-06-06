<?php

namespace Database\Seeders;

use App\Models\Countries;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = ['Colombia'];
        foreach ($countries as $country) {
            Countries::insert([ 'name' => $country ]);
        }
    }
}

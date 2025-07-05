<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class HotelFeatureTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $data = [
                   'name'           => 'Hotel Decameron Medellin', 
                   'nit'            => '9001234564', 
                   'address'        => 'Calle arepa con 56', 
                   'city_id'        =>  1, 
                   'rooms_capacity' =>  200, 
                   'email'          =>  'decameronmedellin@decameron.com', 
                   'phone'          =>  '3024267856', 
                   'status'         =>  1
                ];

        DB::table('countries')->insert([
            'id' => 1,
            'name' => 'Colombia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cities')->insert([
            'id'         => 1,
            'name'       => 'Bogotá',
            'country_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->postJson('/api/hotels/store', $data);
        $response->assertStatus(200);

        $this->assertDatabaseHas('hotels', [
            'name'           => 'Hotel Decameron Medellin', 
            'nit'            => '9001234564', 
            'address'        => 'Calle arepa con 56', 
            'city_id'        =>  1, 
            'rooms_capacity' =>  200, 
            'email'          =>  'decameronmedellin@decameron.com', 
            'phone'          =>  '3024267856', 
            'status'         =>  1
        ]);
    }
}

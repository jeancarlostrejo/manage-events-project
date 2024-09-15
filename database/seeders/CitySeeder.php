<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::insert([
            ['country_id' => 1, 'name' => 'Guasdualito'],
            ['country_id' => 1, 'name' => 'San Cristóbal'],
            ['country_id' => 1, 'name' => 'Caracas'],
            ['country_id' => 2, 'name' => 'Arauca'],
            ['country_id' => 2, 'name' => 'Cúcuta'],
            ['country_id' => 2, 'name' => 'Bogotá'],
            ['country_id' => 3, 'name' => 'Ciudad de México'],
            ['country_id' => 3, 'name' => 'Guadalajara'],
            ['country_id' => 3, 'name' => 'Monterrey'],
        ]);
    }
}

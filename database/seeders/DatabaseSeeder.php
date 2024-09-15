<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Jean Carlos Trejo',
            'email' => 'test@test.com',
        ]);

        $this->call([
            CountrySeeder::class,
            CitySeeder::class,
            TagSeeder::class
        ]);
    }
}

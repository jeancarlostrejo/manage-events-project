<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::insert([
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'Vue js', 'slug' => 'vue-js'],
            ['name' => 'Livewire', 'slug' => 'livewire'],
        ]);

    }
}

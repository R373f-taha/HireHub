<?php

namespace Database\Seeders;

use App\Models\V1\City;

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::factory()->count(30)->create();
    }
}

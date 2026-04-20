<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

     $this->call([CountrySeeder::class,
     CitySeeder::class,UserSeeder::class,ClientSeeder::class,FreelancerSeeder::class
     ,ProjectSeeder::class,SkillSeeder::class,TagSeeder::class,OfferSeeder::class,AttachmentSeeder::class,
     ProfileSeeder::class,ReviewSeeder::class]);
    }
}

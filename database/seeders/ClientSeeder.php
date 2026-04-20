<?php

namespace Database\Seeders;

use App\Models\V1\Client;

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory(20)->create();
    }
}

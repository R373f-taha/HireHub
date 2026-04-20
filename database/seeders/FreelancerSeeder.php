<?php

namespace Database\Seeders;

use App\Models\V1\Freelancer;

use Illuminate\Database\Seeder;

class FreelancerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       Freelancer::factory(20)->create();
    }
}

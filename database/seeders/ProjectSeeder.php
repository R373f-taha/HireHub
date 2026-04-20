<?php

namespace Database\Seeders;

use App\Models\V1\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory()->count(50)->create();
    }
}

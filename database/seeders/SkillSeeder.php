<?php

namespace Database\Seeders;

use App\Models\V1\Freelancer;
use App\Models\V1\Skill;

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $skills=Skill::factory()->count(30)->create();

        $freelancers=Freelancer::all();

      foreach($skills as $skill){
        $randomFreelancer=$freelancers->random(rand(1,10));
         $skill->freelancers()->attach($randomFreelancer,['years_of_experience'=>rand(1,20)]);

      }
    }
}

<?php

namespace Database\Seeders;

use App\Models\V1\Project;
use App\Models\V1\Tag;

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $tags=Tag::factory()->count(30)->create();

      $projets=Project::all();

      foreach($projets as $project){
        $randomTag=$tags->random(rand(1,10));
         $project->tags()->attach($randomTag);
      }
    }
}

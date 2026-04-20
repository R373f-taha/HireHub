<?php

namespace Database\Factories\V1;

use App\Models\V1\Client;
use App\Models\V1\Project;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */


class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

      protected $model=Project::class;
    public function definition(): array
    {
        return [
            'title'=>$this->faker->sentence(3),
            'description'=>$this->faker->paragraph(),
            'deadline'=>$this->faker->dateTimeBetween(now(),'2030-07-24'),
            'type_of_balance'=>$type=$this->faker->randomElement(['fixed','hourly']),
            'project_status'=>$this->faker->randomElement(['open','in_progress','closed']),

            'budget'=>$type==='fixed' ? json_encode([

                "type"=> "fixed",
                "amount"=>rand(500,1000),


            ]):

        json_encode([
            "type"=> "hourly",
            "rate"=> rand(5,50),
            "estimated_hours"=> rand(1,500),
            "min"=>rand(200,500),
            "max"=>rand(500,2000)
            ]),

           'client_id'=>Client::factory()
        ];


    }
}

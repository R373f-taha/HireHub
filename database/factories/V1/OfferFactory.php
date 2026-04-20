<?php

namespace Database\Factories\V1;

use App\Models\V1\Freelancer;
//use App\Models\Model;
use App\Models\V1\Offer;
use App\Models\V1\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
/**
 * @extends Factory<Model>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Offer::class;
    public function definition(): array
    {
        return [
            'project_id'=>Project::factory(),
            'proposed_amount'=>$this->faker->numberBetween(100,1500),
             'submission_latter'=>$this->faker->paragraph(),
             'delivered_days'=>$this->faker->numberBetween(5,60),
             'offer_status'=>$this->faker->randomElement(['pending','accepted','rejected']),
             'freelancer_id'=>Freelancer::factory(),

        ];
    }
}

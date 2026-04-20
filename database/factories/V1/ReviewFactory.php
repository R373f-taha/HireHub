<?php

namespace Database\Factories\V1;

use App\Models\V1\Freelancer;
use App\Models\V1\Offer;
use App\Models\V1\Project;
use App\Models\V1\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model=Review::class;
    public function definition(): array
    {

            $project=Project::where('project_status','closed')->inRandomOrder()->first();

            if(!$project){
                $project=Project::factory()->create(['project_status'=>'closed']);
            }

            $acceptedOffer=$project->offers()->where('offer_status','accepted')->first();

            if(!$acceptedOffer){
                $freelancerId=Freelancer::factory()->create()->id;
                $acceptedOffer=Offer::create([
                    'project_id'=>$project->id,
                    'freelancer_id'=>$freelancerId,
                    'proposed_amount'=>1000,
                    'submission_letter'=>'offer letter',
                    'delivered_days'=>30,
                    'offer_status'=>'accepted',
                ]);
            }
            return [
                 'project_id'=>$project->id,
                 'freelancer_id'=>$acceptedOffer->freelancer_id,
                 'client_id'=>$project->client_id,
                 'comment'=>$this->faker->paragraph(),
                  'freelancer_rating' => $this->faker->numberBetween(1, 5),
                  'project_rating' => $this->faker->numberBetween(1, 5),

            ];


    }
}

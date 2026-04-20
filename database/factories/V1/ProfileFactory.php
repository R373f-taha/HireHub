<?php

namespace Database\Factories\V1;

use App\Models\V1\Freelancer;
use App\Models\V1\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Queue\Middleware\Skip;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model=Profile::class;
    public function definition(): array
    {
        return [
            'bio'=>$this->faker->paragraph(),
             'first_name'=>$this->faker->firstName(),
             'last_name'=>$this->faker->lastName(),
            'image'=>$this->faker->imageUrl(200,200,'people'),
            'protofilo_link'=>$this->faker->url(),
            'hour_rate'=>$this->faker->numberBetween(10,20),
            'phone'=>$this->faker->phoneNumber(),
            'available_mode'=>$this->faker->randomElement(['available','not available','busy']),
             'freelancer_id'=>Freelancer::factory(),
             'skills_summery'=>json_encode([
                 'name' =>$this->faker->word,
                 'info'=>$this->faker->paragraph
             ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

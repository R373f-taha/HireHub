<?php

namespace Database\Factories\V1;

use App\Models\V1\Freelancer;
use App\Models\V1\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Freelancer>
 */
class FreelancerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model=Freelancer::class;
    public function definition(): array
    {
        return [
            'user_id'=>User::factory(),
            'is_verified'=>$this->faker->boolean(60),
            'is_active'=>$this->faker->boolean(60),
            'location_info'=>json_encode([
                'city'=>$this->faker->city(),
                'country'=>$this->faker->country(),
                'address'=>$this->faker->address()
            ])
        ];
    }
}

<?php

namespace Database\Factories\V1;

use App\Models\V1\Client;
use App\Models\V1\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model=Client::class;
    public function definition(): array
    {
        return [
            'user_id'=>User::factory(),
            'location_info'=>json_encode([
                'city'=>$this->faker->city(),
                'country'=>$this->faker->country(),
                'address'=>$this->faker->address()
            ])
        ];
    }
}

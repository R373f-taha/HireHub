<?php

namespace Database\Factories\V1;

use App\Models\V1\City;
use App\Models\V1\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=City::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->unique()->city(),
             'country_id'=>Country :: factory()

        ];
    }
}

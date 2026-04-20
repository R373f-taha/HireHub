<?php

namespace Database\Factories\V1;

use App\Models\V1\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model=Country::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->country()
        ];
    }
}

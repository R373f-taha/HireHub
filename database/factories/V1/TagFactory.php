<?php

namespace Database\Factories\V1;

use App\Models\V1\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected  $model=Tag::class;

    public function definition(): array
    {
        return [
           'name'=> $this->faker->unique()->word()
        ];
    }
}

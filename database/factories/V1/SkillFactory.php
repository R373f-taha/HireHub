<?php

namespace Database\Factories\V1;

use App\Models\V1\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model=Skill::class;
    public function definition(): array
    {
        return [
            'skill_name'=>$this->faker->unique()->word(),


        ];
    }
}

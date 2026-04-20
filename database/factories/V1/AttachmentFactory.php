<?php

namespace Database\Factories\V1;

use App\Models\V1\Attachment;
use App\Models\V1\Project;
use App\Models\V1\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attachment>
 */
class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $table='attachments';

    public function definition(): array
    {
        return [
           'file_name'=>$this->faker->word().'pdf',
            'file_path'=>'uploads/'.$this->faker->word().'pdf',
            'attachable_id'=>$this->faker->randomElement(['Project','Tag'])==='Project'?Project::factory():Tag::factory(),
            'attachable_type'=>$this->faker->randomElement(['Project','Tag'])==='Project'?Project::class:Tag::class

        ];
    }
}

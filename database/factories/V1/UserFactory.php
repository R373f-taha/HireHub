<?php

namespace Database\Factories\V1;

use App\Models\V1\City;
use App\Models\V1\Client;
use App\Models\V1\Country;
use App\Models\V1\Freelancer;
use App\Models\V1\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=User::class;
    public function definition(): array
    {
            $this->createDefaultUsersOnce();
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role'=>$this->faker->randomElement(['client','freelancer','admin']),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'city_id'=>City::factory(),
            'remember_token' => Str::random(10),
        ];
    }


     public static function createDefaultUsersOnce(): void
    {
        static $created = false;

        if ($created) {
            return;
        }

        $created = true;

        $city = City::first();

        if (!$city) {

            $country = Country::factory()->create();
            $city = City::factory()->create(['country_id' => $country->id]);
        }

        User::updateOrCreate(
            ['email' => 'admin@hirehub.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'city_id' => $city->id,
                'email_verified_at' => now(),
            ]
        );


        $clientUser = User::updateOrCreate(
            ['email' => 'client@hirehub.com'],
            [
                'name' => 'Client Demo',
                'password' => Hash::make('client123'),
                'role' => 'client',
                'city_id' => $city->id,
                'email_verified_at' => now(),
            ]
        );

        Client::updateOrCreate(
            ['user_id' => $clientUser->id],
            ['location_info' => json_encode(['address' => 'Client Address', 'phone' => '123456789'])]
        );

        $freelancerUser = User::updateOrCreate(
            ['email' => 'freelancer@hirehub.com'],
            [
                'name' => 'Freelancer Demo',
                'password' => Hash::make('freelancer123'),
                'role' => 'freelancer',
                'city_id' => $city->id,
                'email_verified_at' => now(),
            ]
        );
        Freelancer::updateOrCreate(
            ['user_id' => $freelancerUser->id],
            [
                'is_verified' => true,
                'is_active' => true,
                'location_info' => json_encode(['address' => 'Freelancer Address', 'skills' => ['PHP', 'Laravel']]),
            ]
        );
    }



    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

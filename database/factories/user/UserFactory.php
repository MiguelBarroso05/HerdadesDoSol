<?php

namespace Database\Factories\user;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user\User>
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
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->firstName . '.'. $this->faker->lastName . '@gmail.com',
            'nif' => $this->faker->unique()->numerify('#########'),
            'password' => Hash::make('password'),
            'birthdate' => $this->faker->date( 'Y-m-d','before:18 years ago'),
            'nationality' => $this->faker->country,
            'language' => 1,
            'standard_group' => $this->faker->numberBetween(1,3),
            'children' => $this->faker->numberBetween(0,4),
            'phone' => $this->faker->unique()->numerify('#########'),
            'img' => null,
            'balance' => $this->faker->numberBetween(0, 100),
        ];
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

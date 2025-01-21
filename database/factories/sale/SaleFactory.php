<?php

namespace Database\Factories\sale;

use App\Models\user\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\sale\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::inRandomOrder()->first()->id,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'created_at' => $this->faker->date()
        ];
    }
}

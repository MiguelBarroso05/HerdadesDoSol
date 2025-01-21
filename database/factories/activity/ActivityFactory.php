<?php

namespace Database\Factories\activity;

use App\Models\activity\ActivityType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\activity\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity_type_id' => ActivityType::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(15),
            'img' => null,
        ];
    }
}

<?php

namespace Database\Factories\accommodation;

use App\Models\accommodation\AccommodationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\accommodation\Accommodation>
 */
class AccommodationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'accommodation_type_id' => AccommodationType::factory(),
            'size' => $this->faker->numberBetween(1, 6),
            'description' => $this->faker->sentence(10),
            'img' => null,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Constants;
use App\Models\Cycle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cycle>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'entity_id' => User::factory(),
            'type' => Constants::ACTIVITY_ATTENDANCE,
            'description' => fake()->paragraph(1),
        ];
    }
}

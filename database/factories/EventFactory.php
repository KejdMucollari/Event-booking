<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'starts_at' => fake()->dateTimeBetween('+1 week', '+ 1 month'),
            'location' => fake()->city(),
            'ticket_price' => fake()->randomFloat(2, 10, 200),
            'available_seats' => fake()->numberBetween(50, 250)
        ];
    }
}

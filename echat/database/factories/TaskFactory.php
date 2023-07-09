<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(),
            'status' => fake()->randomElement(['not done', 'done']),
            'priority' => fake()->randomElement([1, 2, 3]),
            'user_id' => 1,
            'created_at' => fake()->dateTime(),
            ];
    }
}

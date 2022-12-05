<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'title' => fake()->text(20),
            'description' => fake()->realText(200),
            'assigned_by_id' => fake()->numberBetween(1,99), // 100 admins
            'assigned_to_id' => fake()->numberBetween(100,10099) // 10000 users
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'letter' => $this->faker->randomLetter,
            'description' => $this->faker->paragraph(1),
            'color' => '#' . substr(str_shuffle('0123456789ABCDEF'), 0, 6),
            'color_description' => $this->faker->paragraph(1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

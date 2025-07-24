<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Division>
 */
class DivisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('ru_RU');
        $faker->addProvider(new \Faker\Provider\ru_RU\Person($faker));

        return [
            'level0' => $faker->company(),
            'level1' => $faker->jobTitle(),
            'position' => $faker->jobTitle(),
            'description' => $faker->words(rand(5, 20), true),
        ];
    }
}

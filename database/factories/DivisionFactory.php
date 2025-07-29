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
            'level0_full' => $faker->company(),
            'level0_short' => 'QWE',
            'level1_full' => $faker->jobTitle(),
            'level1_short' => 'ASD',
            'level2_full' => $faker->jobTitle() . ' ' . $faker->company(),
            'level3_short' => 'ZXC',
            'description' => $faker->words(rand(5, 20), true),
        ];
    }
}

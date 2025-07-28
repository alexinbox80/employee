<?php

namespace Database\Factories;

use App\Models\Division;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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

        $firstName = $faker->firstName();
        $lastName = $faker->lastName();

        // Определяем падеж и добавляем окончание для отчества
        if (mb_substr($firstName, -1) == 'а') {
            $middleName = mb_substr($lastName, 0, -2) . 'вна';
        } else {
            $middleName = mb_substr($lastName, 0, -2) . 'вич';
        }

        return [
            'division_id' => rand(1, 30),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $middleName,
            'email' => $faker->unique()->safeEmail(),
            'phone' => $faker->e164PhoneNumber(),
            'address' => $faker->address(),
        ];
    }
}

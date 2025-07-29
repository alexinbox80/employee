<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schedules')->insert($this->getData());
    }

    private function getData(): array
    {
        $faker = Faker::create('ru_RU');
        $faker->addProvider(new \Faker\Provider\ru_RU\Person($faker));

        $schedules = [];
        $index = -1;
        for ($i = 0; $i < 1000; $i++) {
            for ($m = 0; $m < 12; $m++) {
                $index++;
                $employeeId = rand(1, 100);
                $statusId = rand(1, 6);
                $date = Carbon::now('Europe/Moscow')->subMonths($m)->toDateString();

                $schedules[$index] = [
                    'employee_id' => $employeeId,
                    'status_id' => $statusId,
                    'date' => $date,
                    'description' => $faker->words(rand(5, 20), true),
                    'created_at' => now('Europe/Moscow'),
                ];
            }
        }

        $index = -1;
        for ($i = 0; $i < 100; $i++) {
            for ($d = 1; $d <= date('t', time()); $d++) {
                $index++;
                $employeeId = rand(1, 100);
                $statusId = rand(1, 6);
                $dateM = Carbon::now('Europe/Moscow')->format('m');
                //$date = Carbon::now('Europe/Moscow')->subDays($d)->toDateString();
                $date = '2025-' . $dateM . '-' . rand(1, date('t', time()));
                $schedules[$index] = [
                    'employee_id' => $employeeId,
                    'status_id' => $statusId,
                    'date' => $date,
                    'description' => $faker->words(rand(5, 20), true),
                    'created_at' => now('Europe/Moscow'),
                ];
            }
        }

        return $schedules;
    }
}

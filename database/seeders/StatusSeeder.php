<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert($this->getData());
    }

    private function getData(): array
    {
        $status_array = ['О', 'Б', 'Д', 'Г', 'П', 'Н'];
        $description_array = ['Отпуск', 'Больничный', 'Дежурный', 'Отгул', 'ППС', 'Дежурный руководитель'];
        $statuses = [];

        for ($i = 0; $i < count($status_array); $i++) {
            $statuses[$i] = [
                'letter' => $status_array[$i],
                'description' => $description_array[$i],
                'color' => '#FFCCFF',
                'color_description' => 'желтый цвет',
                'created_at' => now('Europe/Moscow'),
            ];
        }

        return $statuses;
    }
}

<?php

namespace App\Repositories\Contracts;

use App\DTO\CreateScheduleDTO;
use App\DTO\UpdateScheduleDTO;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ScheduleContract
{
    public function getAll(int $month, int $year): Collection;
    public function getPaginated(): LengthAwarePaginator;
    public function getSchedules(): Collection;
    public function getSchedulesByEmployeeId(int $employeeId): Collection;
    public function getScheduleById(int $id): Schedule;
    public function createSchedule(CreateScheduleDTO $scheduleDTO): bool;
    public function updateSchedule(UpdateScheduleDTO $scheduleDTO, int $scheduleId): Schedule;
    public function deleteSchedule(int $employeeId, int $statusId, string $date): int;
    public function store(array $schedule): Schedule;
    public function destroy(int $scheduleId): int;
}

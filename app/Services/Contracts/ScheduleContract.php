<?php

namespace App\Services\Contracts;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ScheduleContract
{
    public function getAll(int $month, int $year): array;
    public function getPaginated(): array;
    public function getSchedules(): Collection;
    public function getSchedulesByEmployeeId(int $employeeId): Collection;
    public function getScheduleById(int $id): Schedule;
    public function createSchedule(array $schedules): bool;
    public function updateSchedule(array $schedule, int $scheduleId): Schedule;
    public function deleteSchedule(int $employeeId, int $statusId, string $date): int;
    public function store(array $schedule): Schedule;
    public function destroy(int $scheduleId): int;
}

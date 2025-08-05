<?php

namespace App\Services\Contracts;

use App\Http\Requests\Schedules\StoreScheduleRequest;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ScheduleContract
{
    public function getPaginated(): LengthAwarePaginator;
    public function getSchedules(): Collection;
    public function getSchedulesByEmployeeId(int $employeeId): Collection;
    public function getScheduleById(int $id): Schedule;
    public function createSchedule(array $schedules): bool;
    public function deleteSchedule(int $employeeId, int $statusId, string $date): int;
    public function store(array $schedule): bool;
    public function destroy(int $scheduleId): int;
}

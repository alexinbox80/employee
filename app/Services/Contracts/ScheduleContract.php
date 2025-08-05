<?php

namespace App\Services\Contracts;

use App\Http\Requests\Schedules\StoreScheduleRequest;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Collection;

interface ScheduleContract
{
    public function getSchedules(): Collection;
    public function getSchedulesByEmployeeId(int $employeeId): Collection;
    public function getScheduleById(int $id): Schedule;
    public function createSchedule(array $schedules): bool;
    public function deleteSchedule(int $employeeId, int $statusId, string $date): int;
}

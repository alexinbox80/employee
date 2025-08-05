<?php

namespace App\Services;

use App\Models\Schedule;
use App\Services\Contracts\ScheduleContract;
use App\Repositories\Contracts\ScheduleContract as ScheduleRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class ScheduleService implements ScheduleContract
{
    public function __construct(
        private readonly ScheduleRepositoryContract $scheduleRepository
    )
    {
    }

    public function getSchedules(): Collection
    {
        return $this->scheduleRepository->getSchedules();
    }

    public function getSchedulesByEmployeeId(int $employeeId): Collection
    {
        return $this->scheduleRepository->getSchedulesByEmployeeId($employeeId);
    }

    public function getScheduleById(int $id): Schedule
    {
        return $this->scheduleRepository->getScheduleById($id);
    }

    public function createSchedule(array $schedules): bool
    {
        Log::info(json_encode($schedules));

        $employeeId = 5;
        $statusId = 2;
        $date = '2025-11-11';

        return $this->scheduleRepository->createSchedule($employeeId, $statusId, $date);
    }

    public function deleteSchedule(int $employeeId, int $statusId, string $date): int
    {
        return $this->scheduleRepository->deleteSchedule($employeeId, $statusId, $date);
    }
}

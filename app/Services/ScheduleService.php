<?php

namespace App\Services;

use App\Models\Schedule;
use App\Services\Contracts\ScheduleContract;
use App\Repositories\Contracts\ScheduleContract as ScheduleRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class ScheduleService implements ScheduleContract
{
    public function __construct(
        private readonly ScheduleRepositoryContract $scheduleRepository
    )
    {
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->scheduleRepository->getPaginated();
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
        foreach ($schedules['schedules'] as $schedule) {
            if ($schedule['isDelete'] === false) {
                $result = $this->scheduleRepository->createSchedule(
                    $schedule['employee_id'], $schedule['status_id'], $schedule['date']
                );

                if (!$result) {
                    return false;
                }
            }

            if ($schedule['isDelete'] === true) {
                $result = $this->scheduleRepository->deleteSchedule(
                    $schedule['employee_id'], $schedule['status_id'], $schedule['date']
                );

                if (!$result) {
                    return false;
                }
            }
        }
        return true;
    }

    public function deleteSchedule(int $employeeId, int $statusId, string $date): int
    {
        return $this->scheduleRepository->deleteSchedule($employeeId, $statusId, $date);
    }

    public function store(array $schedule): bool
    {
        return $this->scheduleRepository->store($schedule);
    }

    public function destroy(int $scheduleId): int
    {
        return $this->scheduleRepository->destroy($scheduleId);
    }
}

<?php

namespace App\Services;

use App\DTO\CreateScheduleDTO;
use DateTime;
use App\Models\Schedule;
use App\Services\Contracts\ScheduleContract;
use App\Repositories\Contracts\ScheduleContract as ScheduleRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

final class ScheduleService implements ScheduleContract
{
    public function __construct(
        private readonly ScheduleRepositoryContract $scheduleRepository
    )
    {
    }

    public function getAll(int $month = null, int $year = null): array
    {
        $date = new DateTime();

        if ($month === null) {
            $month = $date->modify('+1 month')->format('m');
        }

        if ($year === null) {
            $year = $date->format('Y');
        }

        return ['data' => $this->scheduleRepository->getAll($month, $year)];
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
        Log::info(json_encode($schedules));
        foreach ($schedules['schedules'] as $schedule) {
            if ($schedule['isDelete'] === false) {
                $result = $this->scheduleRepository->createSchedule(
                    new CreateScheduleDTO(
                        employeeId: $schedule['employeeId'],
                        statusId: $schedule['statusId'],
                        date: $schedule['date']
                    )
                );

                if (!$result) {
                    return false;
                }
            }

            if ($schedule['isDelete'] === true) {
                $result = $this->scheduleRepository->deleteSchedule(
                    $schedule['employeeId'], $schedule['statusId'], $schedule['date']
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

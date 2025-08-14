<?php

namespace App\Repositories;

use App\DTO\CreateScheduleDTO;
use App\DTO\UpdateScheduleDTO;
use App\Models\Schedule;
use App\Repositories\Contracts\ScheduleContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class ScheduleRepository implements ScheduleContract
{
    public function getAll(int $month, int $year): Collection
    {
        $dateL = $year . '-' . $month . '-01';
        $lastDayOfMonth = (int)date('t', strtotime($dateL . ' 01:01:01'));
        $dateR = $year . '-' . $month . '-' . $lastDayOfMonth;

        return Schedule::where('date', '>=', $dateL)->where('date', '<=', $dateR)
            ->orderBy('employee_id')
            ->orderBy('status_id')
            ->get();
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return Schedule::paginate(config('pagination.admin.schedules'));
    }

    public function getSchedules(): Collection
    {
        return Schedule::all();
    }

    public function getSchedulesByEmployeeId(int $employeeId): Collection
    {
        return Schedule::query()->where('employee_id', $employeeId)->get();
    }

    public function getScheduleById(int $id): Schedule
    {
        return Schedule::query()->findOrFail($id);
    }

    public function createSchedule(CreateScheduleDTO $scheduleDTO): bool
    {
        $schedule = Schedule::create([
            'employee_id' => $scheduleDTO->employeeId,
            'status_id' => $scheduleDTO->statusId,
            'date' => Schedule::dateConvert($scheduleDTO->date),
        ]);

        return isset($schedule);
    }

    public function updateSchedule(UpdateScheduleDTO $scheduleDTO, int $scheduleId): Schedule
    {
        $schedule = Schedule::find($scheduleId);
        $schedule->update([
            'employee_id' => $scheduleDTO->employeeId,
            'status_id' => $scheduleDTO->statusId,
            'date' => Schedule::dateConvert($scheduleDTO->date),
        ]);

        return $schedule->refresh();
    }

    public function deleteSchedule(int $employeeId, int $statusId, string $date): int
    {
        $schedule = Schedule::where([
            'employee_id' => $employeeId,
            'status_id' => $statusId,
            'date' => Schedule::dateConvert($date)
            ])->first();
        return $schedule->delete();
    }

    public function store(array $schedule): Schedule
    {
        $schedules = new Schedule(
            $schedule
        );

        $schedules->save();

        return $schedules->refresh();
    }

    public function destroy(int $scheduleId): int
    {
        return Schedule::destroy($scheduleId);
    }
}

<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Repositories\Contracts\ScheduleContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class ScheduleRepository implements ScheduleContract
{
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

    public function createSchedule(int $employeeId, int $statusId, string $date): bool
    {
        $schedule = Schedule::create([
            'employee_id' => $employeeId,
            'status_id' => $statusId,
            'date' => Schedule::dateConvert($date),
        ]);

        return isset($schedule);
    }

    public function deleteSchedule(int $employeeId, int $statusId, string $date): int
    {
        $schedule = Schedule::where([
            'employee_id' => $employeeId,
            'status_id' => $statusId,
            'date' => Schedule::dateConvert($date
            )])->first();
        $schedule->delete();

        return $schedule;
    }

    public function store(array $schedule): bool
    {
        $schedules = new Schedule(
            $schedule
        );

        return $schedules->save();
    }

    public function destroy(int $scheduleId): int
    {
        return  Schedule::destroy($scheduleId);
    }
}

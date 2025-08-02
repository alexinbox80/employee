<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeContract;
use Illuminate\Database\Eloquent\Collection;


final class EmployeeRepository implements EmployeeContract
{
    public function getEmployeesForPage(int $month, int $year): Collection
    {
        $dateL = $year . '-' . $month . '-01';
        $lastDayOfMonth = (int)date('t', strtotime($dateL . ' 01:01:01'));
        $dateR = $year . '-' . $month . '-' . $lastDayOfMonth;

        return Employee::query()
            ->with(['division', 'schedules' => function ($query) use ($dateL, $dateR) {
                $query->where('date', '>=', $dateL)->where('date', '<=', $dateR);
            }])->orderBy('division_id')
            ->orderBy('last_name')
            ->get();
    }
}

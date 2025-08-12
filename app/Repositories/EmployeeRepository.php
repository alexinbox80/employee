<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DateTime;


final class EmployeeRepository implements EmployeeContract
{
    public function getEmployeesForPage(int $month, int $year, bool $isShown = true): Collection
    {
        $dateL = $year . '-' . $month . '-01';
        $lastDayOfMonth = (int)date('t', strtotime($dateL . ' 01:01:01'));
        $dateR = $year . '-' . $month . '-' . $lastDayOfMonth;

        return Employee::query()
            ->with(['division', 'schedules' => function ($query) use ($dateL, $dateR) {
                $query->where('date', '>=', $dateL)->where('date', '<=', $dateR);
            }])->where('is_shown', $isShown)
            ->orderBy('division_id')
            ->orderBy('last_name')
            ->get();
    }

    public function getEmployeesForDocx(int $month, int $year, bool $isShown = true): Collection
    {
        $dateL = $year . '-' . $month . '-01';
        $lastDayOfMonth = (int)date('t', strtotime($dateL . ' 01:01:01'));
        $dateR = $year . '-' . $month . '-' . $lastDayOfMonth;

        return Employee::query()
            ->with(['division', 'schedules' => function ($query) use ($dateL, $dateR) {
                $query->where('date', '>=', $dateL)->where('date', '<=', $dateR)->orderBy('date', 'asc');
            }])->where('is_shown', $isShown)
            ->orderBy('division_id')
            ->orderBy('last_name')
            ->get();
    }

    public function getEmployeesForPageById(int $divisionId): Collection
    {
        return Employee::query()->where('division_id', $divisionId)->orderBy('last_name')->get();
    }

    public function findById(int $id): Employee
    {
        return Employee::query()->findOrFail($id);
    }

    public function getAll(): Collection
    {
        return Employee::all();
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return Employee::paginate(config('pagination.admin.employees'));
    }

    public function getEmployees(): Collection
    {
        return Employee::all();
    }

    public function getEmployeesByDepartmentId(int $departmentId): Collection
    {
        return Employee::query()->where('department_id', $departmentId)->get();
    }

    public function getEmployeesByDivisionId(int $divisionId): Collection
    {
        return Employee::query()->where('division_id', $divisionId)->get();
    }


    public function getEmployeeById(int $id): Employee
    {
        return Employee::query()->findOrFail($id);
    }

    public function createEmployee(
        int $divisionId,
        int $departmentId,
        bool $isShown,
        string $lastName,
        string $firstName,
        string $middleName,
        DateTime $birthDate,
        string $sex,
        string $position,
        string $email,
        string $homePhone,
        string $workPhone,
        string $mobilePhone,
        string $address,
        int $room

    ): bool
    {
        $employee= Employee::create([
            'division_id' => $divisionId,
            'department_id' => $departmentId,
            'is_shown' => $isShown,
            'last_name' => $lastName,
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'birth_date' => $birthDate,
            'sex' => $sex,
            'position' => $position,
            'email' => $email,
            'home_phone' => $homePhone,
            'work_phone' => $workPhone,
            'mobile_phone' => $mobilePhone,
            'address' => $address,
            'room' => $room
        ]);

        return isset($employee);
    }

    public function deleteEmployee(int $divisionId, int $departmentId): int
    {
        $employee = Employee::where([
            'division_id' => $divisionId,
            'department_id' => $departmentId,
        ])->first();
        return $employee->delete();
    }

    public function store(array $employee): bool
    {
        $employees = new Employee(
            $employee
        );

        return $employees->save();
    }

    public function destroy(int $employeeId): int
    {
        return Employee::destroy($employeeId);
    }}

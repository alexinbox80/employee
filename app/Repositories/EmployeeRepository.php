<?php

namespace App\Repositories;

use App\DTO\CreateEmployeeDTO;
use App\DTO\UpdateEmployeeDTO;
use App\Models\Employee;
use App\Repositories\Contracts\EmployeeContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function createEmployee(CreateEmployeeDTO $employeeDTO): Employee
    {
        $employee = Employee::create([
            'division_id' => $employeeDTO->divisionId,
            'department_id' => $employeeDTO->departmentId,
            'is_shown' => $employeeDTO->isShown,
            'last_name' => $employeeDTO->lastName,
            'first_name' => $employeeDTO->firstName,
            'middle_name' => $employeeDTO->middleName,
            'birth_date' => $employeeDTO->birthDate,
            'sex' => $employeeDTO->sex,
            'position' => $employeeDTO->position,
            'email' => $employeeDTO->email,
            'home_phone' => $employeeDTO->homePhone,
            'work_phone' => $employeeDTO->workPhone,
            'mobile_phone' => $employeeDTO->mobilePhone,
            'address' => $employeeDTO->address,
            'room' => $employeeDTO->room
        ]);

        return $employee->refresh();
    }

    public function updateEmployee(UpdateEmployeeDTO $employeeDTO, int $employeeId): Employee
    {
        $employee = Employee::find($employeeId);
        $employee->update([
            'division_id' => $employeeDTO->divisionId,
            'department_id' => $employeeDTO->departmentId,
            'is_shown' => $employeeDTO->isShown,
            'last_name' => $employeeDTO->lastName,
            'first_name' => $employeeDTO->firstName,
            'middle_name' => $employeeDTO->middleName,
            'birth_date' => $employeeDTO->birthDate,
            'sex' => $employeeDTO->sex,
            'position' => $employeeDTO->position,
            'email' => $employeeDTO->email,
            'home_phone' => $employeeDTO->homePhone,
            'work_phone' => $employeeDTO->workPhone,
            'mobile_phone' => $employeeDTO->mobilePhone,
            'address' => $employeeDTO->address,
            'room' => $employeeDTO->room
        ]);

        return $employee->refresh();
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

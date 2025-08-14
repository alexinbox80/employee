<?php

namespace App\Services;

use App\DTO\CreateEmployeeDTO;
use App\DTO\UpdateEmployeeDTO;
use App\Models\Division;
use App\Models\Employee;
use App\Repositories\Contracts\DivisionContract as DivisionRepositoryContract;
use App\Repositories\Contracts\EmployeeContract as EmployeeRepositoryContract;
use App\Services\Contracts\EmployeeContract;
use Illuminate\Support\Collection;

final class EmployeeService implements EmployeeContract
{
    public function __construct(
        private readonly EmployeeRepositoryContract $employeeRepository,
        private readonly DivisionRepositoryContract $divisionRepository,
    )
    {
    }

    public function index(int $month = null, int $year = null): array
    {
        if ($month === null) {
            $month = date('m');
        }

        if ($year === null) {
            $year = date('Y');
        }

        $employees = $this->employeeRepository->getEmployeesForPage($month, $year);

        return ['employees' => $employees, 'month' => $month, 'year' => $year];
    }

    public function indexDocx(int $month = null, int $year = null): array
    {
        if ($month === null) {
            $month = date('m');
        }

        if ($year === null) {
            $year = date('Y');
        }

        $employees = $this->employeeRepository->getEmployeesForDocx($month, $year);

        return ['employees' => $employees, 'month' => $month, 'year' => $year];
    }

    public function getDivisionById(int $divisionId): array
    {
        return [
            'employees' => $this->employeeRepository->getEmployeesForPageById($divisionId)
        ];
    }

    public function findEmployeeById(int $id): Employee
    {
        return $this->employeeRepository->findById($id);
    }

    public function findDivisionById(int $id): Division
    {
        return $this->divisionRepository->findById($id);
    }

    public function getAll(): array
    {
        return ['data' => $this->divisionRepository->getAll()];
    }

    public function getPaginated(): array
    {
        return [
            'data' => $this->employeeRepository->getPaginated()
        ];
    }

    public function getEmployees(): Collection
    {
        return $this->employeeRepository->getEmployees();
    }

    public function getEmployeeById(int $id): Employee
    {
        return $this->employeeRepository->getEmployeeById($id);
    }

    public function createEmployee(array $employee): Employee
    {
        return $this->employeeRepository->createEmployee(
            new CreateEmployeeDTO(
                divisionId: $employee['division_id'],
                departmentId: $employee['department_id'],
                isShown: $employee['is_shown'],
                lastName: $employee['last_name'],
                firstName: $employee['first_name'],
                middleName: $employee['middle_name'],
                birthDate: date('Y-m-d', strtotime($employee['birth_date'])),
                sex: $employee['sex'],
                position: $employee['position'],
                email: $employee['email'] ?? null,
                homePhone: $employee['home_phone'] ?? null,
                workPhone: $employee['work_phone'] ?? null,
                mobilePhone: $employee['mobile_phone'] ?? null,
                address: $employee['address'],
                room: $employee['room'] ?? null
            )
        );
    }

    public function updateEmployee(array $employee, int $employeeId): Employee
    {
        $employeeDTO = new UpdateEmployeeDTO(
            divisionId: $employee['division_id'],
            departmentId: $employee['department_id'],
            isShown: $employee['is_shown'],
            lastName: $employee['last_name'],
            firstName: $employee['first_name'],
            middleName: $employee['middle_name'],
            birthDate: date('Y-m-d', strtotime($employee['birth_date'])),
            sex: $employee['sex'],
            position: $employee['position'],
            email: $employee['email'] ?? null,
            homePhone: $employee['home_phone'] ?? null,
            workPhone: $employee['work_phone'] ?? null,
            mobilePhone: $employee['mobile_phone'] ?? null,
            address: $employee['address'],
            room: $employee['room'] ?? null
        );

        return $this->employeeRepository->updateEmployee($employeeDTO, $employeeId);
    }

    public function deleteEmployee(int $divisionId, int $departmentId): int
    {
        return $this->employeeRepository->deleteEmployee($divisionId, $departmentId);
    }

    public function store(array $employee): bool
    {
        return $this->employeeRepository->store($employee);
    }

    public function destroy(int $employeeId): int
    {
        return $this->employeeRepository->destroy($employeeId);
    }
}

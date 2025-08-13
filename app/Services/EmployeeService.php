<?php

namespace App\Services;

use App\DTO\CreateEmployeeDTO;
use App\Models\Division;
use App\Models\Employee;
use App\Repositories\Contracts\DivisionContract as DivisionRepositoryContract;
use App\Repositories\Contracts\EmployeeContract as EmployeeRepositoryContract;
use App\Services\Contracts\EmployeeContract;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->employeeRepository->getPaginated();
    }

    public function getEmployees(): Collection
    {
        return $this->employeeRepository->getEmployees();
    }

    public function getEmployeeById(int $id): Employee
    {
        return $this->employeeRepository->getEmployeeById($id);
    }

    public function createEmployee(array $employee): bool
    {
        $result = $this->employeeRepository->createEmployee(
            new CreateEmployeeDTO(
                divisionId: $employee['divisionId'],
                departmentId: $employee['departmentId'],
                isShown: $employee['isShown'],
                lastName: $employee['lastName'],
                firstName: $employee['firstName'],
                middleName: $employee['middleName'],
                birthDate: $employee['birthDate'],
                sex: $employee['sex'],
                position: $employee['position'],
                email: $employee['email'],
                homePhone: $employee['homePhone'],
                workPhone: $employee['workPhone'],
                mobilePhone: $employee['mobilePhone'],
                address: $employee['address'],
                room: $employee['room']
            )
        );

        if (!$result) {
            return false;
        }

        return true;
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

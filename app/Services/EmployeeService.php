<?php

namespace App\Services;

use App\Models\Division;
use App\Models\Employee;
use App\Repositories\Contracts\DivisionContract as DivisionRepositoryContract;
use App\Repositories\Contracts\EmployeeContract as EmployeeRepositoryContract;
use App\Services\Contracts\EmployeeContract;

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
}

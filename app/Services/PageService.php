<?php

namespace App\Services;

use App\Models\Division;
use App\Models\Employee;
use App\Repositories\Contracts\DivisionContract;
use App\Repositories\Contracts\EmployeeContract;
use App\Services\Contracts\PageContract;
use Illuminate\Http\Request;

final class PageService implements PageContract
{
    public function __construct(
        private readonly EmployeeContract $employeeRepository,
        private readonly DivisionContract $divisionRepository,
    )
    {
    }

    public function index(Request $request): array
    {
        $month = $request->query('month');
        $year = $request->query('year');

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

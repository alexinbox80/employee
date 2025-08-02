<?php

namespace App\Services;

use App\Repositories\Contracts\EmployeeContract;
use App\Services\Contracts\PageContract;
use Illuminate\Http\Request;

final class PageService implements PageContract
{
    public function __construct(
        private readonly EmployeeContract $employeeRepository,
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
}

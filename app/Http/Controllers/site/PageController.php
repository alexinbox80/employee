<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Services\Contracts\StatusContract;
use App\Services\Contracts\EmployeeContract;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class PageController extends Controller
{
    public function __construct(
        private readonly EmployeeContract $employeeService,
        private readonly StatusContract $statusService,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $result = $this->employeeService->index($month, $year);

        return view('index', [
            'employees' => $result['employees'],
            'month' => $result['month'],
            'year' => $result['year'],
        ]);
    }

    public function getEmployeeById(int $employeeId): View
    {
        return view('employee', [
            'employee' => $this->employeeService->findEmployeeById($employeeId),
        ]);
    }

    public function getDivisionById(Division $division): View
    {
        $result = $this->employeeService->getDivisionById($division->id);

        return view('division', [
            'division' => $division,
            'employees' => $result['employees']
        ]);
    }

    public function create(Request $request): View
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $result = $this->employeeService->index($month, $year);

        return view('create', [
            'employees' => $result['employees'],
            'statuses' => $this->statusService->getStatuses(),
            'month' => $result['month'],
            'year' => $result['year'],
        ]);
    }
}

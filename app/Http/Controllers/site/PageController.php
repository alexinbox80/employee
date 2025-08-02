<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Employee;
use App\Services\Contracts\PageContract;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class PageController extends Controller
{
    public function __construct(
        private readonly PageContract $pageService,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $result = $this->pageService->index($request);

        return view('index', [
            'employees' => $result['employees'],
            'month' => $result['month'],
            'year' => $result['year'],
        ]);
    }

    public function getEmployeeById(Employee $employee): View
    {
        return view('employee', [
            'employee' => $employee
        ]);
    }

    public function getDivisionById(Division $division): View
    {
        $employees = Employee::query()->where('division_id', $division->id)->orderBy('last_name')->get();

        return view('division', [
            'division' => $division,
            'employees' => $employees
        ]);
    }
}

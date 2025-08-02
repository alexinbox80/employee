<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Division;
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

    public function getEmployeeById(int $employeeId): View
    {
        return view('employee', [
            'employee' => $this->pageService->findEmployeeById($employeeId),
        ]);
    }

    public function getDivisionById(Division $division): View
    {
        $result = $this->pageService->getDivisionById($division->id);

        return view('division', [
            'division' => $division,
            'employees' => $result['employees']
        ]);
    }
}

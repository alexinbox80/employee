<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $month = $request->query('month');
        $year = $request->query('year');

        if ($month === null) {
            $month = date('m');
        }

        if ($year === null) {
            $year = date('Y');
        }

        $employees = Employee::query()->with(['division', 'schedules'])->orderBy('division_id')->orderBy('last_name')->get();

        return view('index', [
            'employees' => $employees,
            'month' => $month,
            'year' => $year,
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

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\CreateRequest;
use App\Http\Requests\Employees\EditRequest;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Services\Contracts\EmployeeContract as EmployeeServiceContract;

final class EmployeeController extends Controller
{
    public function __construct(
        private readonly  EmployeeServiceContract $employeeService
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $employees = $this->employeeService->getPaginated();

        return view('admin.employees.index', [
            'employees' => $employees['data']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $result = $this->employeeService->store($validated);

        if ($result) {
            return redirect()->route('admin.employees.index')
                ->with('success', __('messages.admin.employees.create.success'));
        }

        return back()->with('error', __('messages.admin.employees.create.fail'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee): View
    {
        return view('admin.employees.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function update(EditRequest $request, Employee $employee): RedirectResponse
    {
        $employee = $employee->fill($request->validated());

        if ($employee->save()) {
            return redirect()->route('admin.employees.index')
                ->with('success', __('messages.admin.employees.update.success'));
        }

        return back()->with('error', __('messages.admin.employees.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     *
     * @return RedirectResponse
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee= $this->employeeService->destroy($employee->id);

        if ($employee) {
            return redirect()->route('admin.employees.index')
                ->with('success', __('messages.admin.employees.destroy.success'));
        }

        return back()->with('error', __('messages.admin.employees.destroy.fail'));
    }
}

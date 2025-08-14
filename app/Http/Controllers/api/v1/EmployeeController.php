<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\CreateRequest;
use App\Http\Requests\Employees\EditRequest;
use App\Http\Resources\EmployeeResource;
use App\Services\Contracts\EmployeeContract as EmployeeServiceContract;
use App\Services\Contracts\ResponseContract;
use Symfony\Component\HttpFoundation\JsonResponse;

final class EmployeeController extends Controller
{
    public function __construct(
        public readonly ResponseContract $responseService,
        public readonly EmployeeServiceContract $employeeService
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $employees = $this->employeeService->getPaginated();

        return $this->responseService->success([
            EmployeeResource::collection($employees['data'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $employee = $this->employeeService->createEmployee($validated);

        if ($employee)
            return $this->responseService->created([
                EmployeeResource::make($employee)
            ]);
        else
            return $this->responseService->unSuccess([
                'message' => __('messages.admin.employees.create.fail')
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $employee = $this->employeeService->getEmployeeById($id);

        return $this->responseService->success([
            EmployeeResource::make($employee)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $division = $this->employeeService->updateEmployee($validated, $id);

        return $this->responseService->success([
            EmployeeResource::make($division)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $employee = $this->employeeService->destroy($id);

        if ($employee)
            return $this->responseService->success([
                'message' => __('messages.admin.employees.destroy.success')
            ]);
        else
            return $this->responseService->unSuccess([
                'message' => __('messages.admin.employees.destroy.fail')
            ]);
    }
}

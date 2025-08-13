<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Divisions\CreateRequest;
use App\Http\Requests\Divisions\EditRequest;
use App\Http\Resources\DivisionResource;
use App\Services\Contracts\DivisionContract as DivisionServiceContract;
use App\Services\Contracts\ResponseContract;
use Symfony\Component\HttpFoundation\JsonResponse;

final class DivisionController extends Controller
{
    public function __construct(
        public readonly ResponseContract $responseService,
        public readonly DivisionServiceContract $divisionService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $divisions = $this->divisionService->getPaginated();

        return $this->responseService->success([
            DivisionResource::collection($divisions['data'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $division = $this->divisionService->createDivision($validated);

        if ($division)
            return $this->responseService->created([
                DivisionResource::make($division)
            ]);
        else
            return $this->responseService->unSuccess([
                'message' => __('messages.admin.divisions.create.fail')
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $division = $this->divisionService->getDivisionById($id);

        return $this->responseService->success([
            DivisionResource::make($division)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $division = $this->divisionService->updateDivision($validated, $id);

        return $this->responseService->success([
            DivisionResource::make($division)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $division = $this->divisionService->destroy($id);

        if ($division)
            return $this->responseService->success([
                'message' => __('messages.admin.divisions.destroy.success')
            ]);
        else
            return $this->responseService->unSuccess([
                'message' => __('messages.admin.divisions.destroy.fail')
            ]);
    }
}

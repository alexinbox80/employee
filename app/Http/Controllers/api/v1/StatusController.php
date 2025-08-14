<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statuses\CreateRequest;
use App\Http\Requests\Statuses\EditRequest;
use App\Http\Resources\StatusResource;
use App\Services\Contracts\StatusContract as StatusServiceContract;
use App\Services\Contracts\ResponseContract;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatusController extends Controller
{
    public function __construct(
        public readonly ResponseContract $responseService,
        public readonly StatusServiceContract $statusService
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $statuses = $this->statusService->getPaginated();

        return $this->responseService->success([
            StatusResource::collection($statuses['data'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $status = $this->statusService->createStatus($validated);

        if ($status)
            return $this->responseService->created([
                StatusResource::make($status)
            ]);
        else
            return $this->responseService->unSuccess([
                'message' => __('messages.admin.statuses.create.fail')
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $status = $this->statusService->getStatusById($id);

        return $this->responseService->success([
            StatusResource::make($status)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $status = $this->statusService->updateStatus($validated, $id);

        return $this->responseService->success([
            StatusResource::make($status)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $status = $this->statusService->destroy($id);

        if ($status)
            return $this->responseService->success([
                'message' => __('messages.admin.statuses.destroy.success')
            ]);
        else
            return $this->responseService->unSuccess([
                'message' => __('messages.admin.statuses.destroy.fail')
            ]);
    }
}

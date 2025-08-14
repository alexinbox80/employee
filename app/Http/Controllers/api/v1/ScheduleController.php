<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedules\StoreScheduleRequest;
use App\Http\Requests\Schedules\CreateRequest;
use App\Http\Requests\Schedules\EditRequest;
use App\Http\Resources\ScheduleCollection;
use App\Http\Resources\ScheduleResource;
use App\Services\Contracts\ScheduleContract as ScheduleServiceContract;
use App\Services\Contracts\ResponseContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ScheduleController extends Controller
{
    public function __construct(
        public readonly ResponseContract $responseService,
        public readonly ScheduleServiceContract $scheduleService
    )
    {
    }

    public function index_blade(Request $request): JsonResponse
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $schedules = $this->scheduleService->getAll($month, $year);
        return response()->json(['data' => ScheduleCollection::collection($schedules['data'])], Response::HTTP_OK);
    }

    public function create_blade(StoreScheduleRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->scheduleService->createSchedule($validated);

        if ( $result === false) {
            return response()->json(['status' => 'error'], Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $schedules = $this->scheduleService->getPaginated();

        return $this->responseService->success([
            ScheduleResource::collection($schedules['data'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $schedule = $this->scheduleService->store($validated);

        if ($schedule)
            return $this->responseService->created([
                ScheduleResource::make($schedule)
            ]);
        else
            return $this->responseService->unSuccess([
                'message' => __('messages.admin.schedules.create.fail')
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $schedule = $this->scheduleService->getScheduleById($id);

        return $this->responseService->success([
            ScheduleResource::make($schedule)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $schedule = $this->scheduleService->updateSchedule($validated, $id);

        return $this->responseService->success([
            ScheduleResource::make($schedule)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $schedule = $this->scheduleService->destroy($id);

        if ($schedule)
            return $this->responseService->success([
                'message' => __('messages.admin.schedules.destroy.success')
            ]);
        else
            return $this->responseService->unSuccess([
                'message' => __('messages.admin.schedules.destroy.fail')
            ]);
    }
}

<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedules\StoreScheduleRequest;
use App\Http\Resources\ScheduleCollection;
use App\Services\Contracts\ScheduleContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ScheduleController extends Controller
{
    public function __construct(
        private readonly ScheduleContract $scheduleService,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $schedules = $this->scheduleService->getAll($month, $year);
        return response()->json(['data' => ScheduleCollection::collection($schedules['data'])], Response::HTTP_OK);
    }

    public function create(StoreScheduleRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->scheduleService->createSchedule($validated);

        if ( $result === false) {
            return response()->json(['status' => 'error'], Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }
    }
}

<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Divisions\CreateRequest;
use App\Http\Requests\Divisions\EditRequest;
use App\Services\Contracts\DivisionContract as DivisionServiceContract;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

final class DivisionController extends Controller
{
    public function __construct(
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
        return response()->json($divisions, JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $division = $this->divisionService->createDivision($validated);

        if ($division) {
            return response()->json(['id' => $division], JsonResponse::HTTP_CREATED);
        } else {
            return response()->json('Error', JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $division = $this->divisionService->getDivisionById($id);

        return response()->json($division, JsonResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $division = $this->divisionService->updateDivision($validated, $id);

        return response()->json($division, JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $division = $this->divisionService->destroy($id);
        return response()->json($division, JsonResponse::HTTP_OK);
    }
}

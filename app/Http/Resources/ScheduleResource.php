<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $schedule = $this->resource;

        return [
            'id' => $schedule->getId(),
            'employee_id' => $schedule->getEmployeeId(),
            'status_id' => $schedule->getStatusId(),
            'date' => $schedule->getDate(),
            'description' => $schedule->getDescription(),
        ];
    }
}

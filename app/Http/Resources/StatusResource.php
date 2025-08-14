<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = $this->resource;

        return [
            'id' => $status->getId(),
            'letter' => $status->getLetter(),
            'description' => $status->getDescription(),
            'color' => $status->getColor(),
            'color_description' => $status->getColorDescription()
        ];
    }
}

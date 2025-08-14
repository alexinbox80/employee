<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $division = $this->resource;

        return [
            'id' => $division->getId(),
            'level0_full' => $division->getLevel0Full(),
            'level0_short' => $division->getLevel0Short(),
            'level1_full' => $division->getLevel1Full(),
            'level1_short' => $division->getLevel1Short(),
            'level2_full' => $division->getLevel2Full(),
            'level2_short' => $division->getLevel2Short(),
            'level3_full' => $division->getLevel3Full(),
            'level3_short' => $division->getLevel3Short(),
            'level4_full' => $division->getLevel4Full(),
            'level4_short' => $division->getLevel4Short(),
            'level5_full' => $division->getLevel5Full(),
            'level5_short' => $division->getLevel5Short(),
            'description' => $division->getDescription()
        ];
    }
}

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
        return [
            'id' => $this->id,
            'level0_full' => $this->level0_full,
            'level0_short' => $this->level0_short,
            'level1_full' => $this->level1_full,
            'level1_short' => $this->level1_short,
            'level2_full' => $this->level2_full,
            'level2_short' => $this->level2_short,
            'level3_full' => $this->level3_full,
            'level3_short' => $this->level3_short,
            'level4_full' => $this->level4_full,
            'level4_short' => $this->level4_short,
            'level5_full' => $this->level5_full,
            'level5_short' => $this->level5_Short,
            'description' => $this->description
        ];
    }
}

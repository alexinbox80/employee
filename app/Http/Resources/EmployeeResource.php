<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $employee = $this->resource;

        return [
            'id' => $employee->getId(),
            'division_id' => $employee->getDivisionId(),
            'department_id' => $employee->getDepartmentId(),
            'is_shown' => $employee->getIsShown(),
            'last_name' => $employee->getLastName(),
            'first_name' => $employee->getFirstName(),
            'middle_name' => $employee->getMiddleName(),
            'birth_date' => $employee->getBirthDate(),
            'sex' => $employee->getSex(),
            'position' => $employee->getPosition(),
            'email' => $employee->getEmail(),
            'home_phone' => $employee->getHomePhone(),
            'work_phone' => $employee->getWorkPhone(),
            'mobile_phone' => $employee->getMobilePhone(),
            'address' => $employee->getAddress(),
            'room' => $employee->getRoom(),
        ];
    }
}

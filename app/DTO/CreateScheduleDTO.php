<?php

namespace App\DTO;

final class CreateScheduleDTO
{
    public function __construct(
        public readonly int $employeeId,
        public readonly int $statusId,
        public readonly string $date
    ) { }
}

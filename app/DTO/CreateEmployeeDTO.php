<?php

namespace App\DTO;

use DateTime;

final class CreateEmployeeDTO
{
    public function __construct(
        public readonly ?int $divisionId = null,
        public readonly ?int $departmentId = null,
        public readonly bool $isShown,
        public readonly string $lastName,
        public readonly string $firstName,
        public readonly string $middleName,
        public readonly DateTime $birthDate,
        public readonly string $sex,
        public readonly string $position,
        public readonly ?string $email = null,
        public readonly ?string $homePhone = null,
        public readonly ?string $workPhone = null,
        public readonly ?string $mobilePhone = null,
        public readonly string $address,
        public readonly ?int $room = null
    ) { }
}

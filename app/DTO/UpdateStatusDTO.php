<?php

namespace App\DTO;

final class UpdateStatusDTO
{
    public function __construct(
        public readonly string $letter,
        public readonly ?string $description = null,
        public readonly string $color,
        public readonly ?string $colorDescription = null,
    ) { }
}

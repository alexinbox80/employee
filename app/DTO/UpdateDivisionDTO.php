<?php

namespace App\DTO;

final class UpdateDivisionDTO
{
    public function __construct(
        public readonly string $level0Full,
        public readonly string $level0Short,
        public readonly string $level1Full,
        public readonly string $level1Short,
        public readonly ?string $level2Full = null,
        public readonly ?string $level2Short = null,
        public readonly ?string $level3Full = null,
        public readonly ?string $level3Short = null,
        public readonly ?string $level4Full = null,
        public readonly ?string $level4Short = null,
        public readonly ?string $level5Full = null,
        public readonly ?string $level5Short = null,
        public readonly ?string $description = null
    ) { }
}

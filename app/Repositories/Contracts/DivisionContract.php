<?php

namespace App\Repositories\Contracts;

use App\Models\Division;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


interface DivisionContract
{
    public function findById(int $id): Division;
    public function getAll(): Collection;
    public function getPaginated(): LengthAwarePaginator;
    public function getDivisions(): Collection;
    public function getDivisionById(int $id): Division;
    public function createSchedule(
        string $level0Full,
        string $level0Short,
        string $level1Full,
        string $level1Short,
        string $level2Full,
        string $level2Short,
        string $level3Full,
        string $level3Short,
        string $level4Full,
        string $level4Short,
        string $level5Full,
        string $level5Short,
        string $description
    ): bool;
    public function deleteDivision(string $level0Full, string $level1Full, string $level2Full): int;
    public function store(array $division): bool;
    public function destroy(int $divisionId): int;

}

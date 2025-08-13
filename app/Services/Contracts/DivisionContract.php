<?php

namespace App\Services\Contracts;

use App\Models\Division;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface DivisionContract
{
    public function getAll(): array;
    public function getPaginated(): LengthAwarePaginator;
    public function getDivisions(): Collection;
    public function getDivisionById(int $id): Division;
    public function createDivision(array $division): Division;
    public function updateDivision(array $division, int $divisionId): Division;
    public function deleteDivision(string $level0Full, string $level1Full, string $level2Full): int;
    public function store(array $division): int;
    public function destroy(int $divisionId): int;
}

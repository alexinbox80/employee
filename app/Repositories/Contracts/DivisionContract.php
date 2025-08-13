<?php

namespace App\Repositories\Contracts;

use App\DTO\CreateDivisionDTO;
use App\DTO\UpdateDivisionDTO;
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
    public function createDivision(CreateDivisionDTO $divisionDTO): Division;
    public function updateDivision(UpdateDivisionDTO $divisionDTO, int $divisionId): Division;
    public function deleteDivision(string $level0Full, string $level1Full, string $level2Full): int;
    public function store(array $division): int;
    public function destroy(int $divisionId): int;
}

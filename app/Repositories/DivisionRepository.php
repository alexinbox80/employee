<?php

namespace App\Repositories;

use App\Models\Division;
use App\Repositories\Contracts\DivisionContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\DTO\CreateDivisionDTO;

final class DivisionRepository implements DivisionContract
{
    public function findById(int $id): Division
    {
        return Division::query()->findOrFail($id);
    }

    public function getAll(): Collection
    {
        return Division::get();
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return Division::paginate(config('pagination.admin.divisions'));
    }

    public function getDivisions(): Collection
    {
        return Division::all();
    }

    public function getDivisionById(int $id): Division
    {
        return Division::query()->findOrFail($id);
    }

    public function createDivision(CreateDivisionDTO $divisionDTO): bool
    {
        $division = Division::create([
            'level0_full' => $divisionDTO->level0Full,
            'level0_short' => $divisionDTO->level0Short,
            'level1_full' => $divisionDTO->level1Full,
            'level1_short' => $divisionDTO->level1Short,
            'level2_full' => $divisionDTO->level2Full,
            'level2_short' => $divisionDTO->level2Short,
            'level3_full' => $divisionDTO->level3Full,
            'level3_short' => $divisionDTO->level3Short,
            'level4_full' => $divisionDTO->level4Full,
            'level4_short' => $divisionDTO->level4Short,
            'level5_full' => $divisionDTO->level5Full,
            'level5_short' => $divisionDTO->level5Short,
            'description' => $divisionDTO->description
        ]);

        return isset($division);
    }

    public function deleteDivision(string $level0Full, string $level1Full, string $level2Full): int
    {
        $division = Division::where([
            'employee_id' => $level0Full,
            'status_id' => $level1Full,
            'level2Full' => $level2Full
        ])->first();
        return $division->delete();
    }

    public function store(array $division): bool
    {
        $divisions = new Division(
            $division
        );

        return $divisions->save();
    }

    public function destroy(int $divisionId): int
    {
        return Division::destroy($divisionId);
    }
}

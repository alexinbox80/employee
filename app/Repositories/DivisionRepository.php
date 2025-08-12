<?php

namespace App\Repositories;

use App\Models\Division;
use App\Repositories\Contracts\DivisionContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
    ): bool
    {

        $division = Division::create([
            'level0_full' => $level0Full,
            'level0_short' => $level0Short,
            'level1_full' => $level1Full,
            'level1_short' => $level1Short,
            'level2_full' => $level2Full,
            'level2_short' => $level2Short,
            'level3_full' => $level3Full,
            'level3_short' => $level3Short,
            'level4_full'  => $level4Full,
            'level4_short' => $level4Short,
            'level5_full' => $level5Full,
            'level5_short' => $level5Short,
            'description' => $description
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

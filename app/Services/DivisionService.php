<?php

namespace App\Services;

use App\DTO\CreateDivisionDTO;
use App\DTO\UpdateDivisionDTO;
use App\Models\Division;
use App\Repositories\Contracts\DivisionContract as DivisionRepositoryContract;
use App\Services\Contracts\DivisionContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class DivisionService implements DivisionContract
{
    public function __construct(
        private readonly DivisionRepositoryContract $divisionRepository
    )
    {
    }

    public function getAll(): array
    {
        return ['data' => $this->divisionRepository->getAll()];
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->divisionRepository->getPaginated();
    }

    public function getDivisions(): Collection
    {
        return $this->divisionRepository->getDivisions();
    }

    public function getDivisionById(int $id): Division
    {
        return $this->divisionRepository->getDivisionById($id);
    }

    public function createDivision(array $division): bool
    {
        $result = $this->divisionRepository->createDivision(
            new CreateDivisionDTO(
                level0Full: $division['level0_full'],
                level0Short: $division['level0_short'],
                level1Full: $division['level1_full'],
                level1Short: $division['level1_short'],
                level2Full: $division['level2_full'],
                level2Short: $division['level2_short'],
                level3Full: $division['level_full'],
                level3Short: $division['level3_short'],
                level4Full: $division['level4_full'],
                level4Short: $division['level4_short'],
                level5Full: $division['level5_full'],
                level5Short: $division['level5_short'],
                description: $division['description']
            )
        );

        if (!$result) {
            return false;
        }

        return true;
    }

    public function updateDivision(array $division, int $divisionId): int
    {
        $divisionDTO = new UpdateDivisionDTO(
            level0Full: $division['level0_full'],
            level0Short: $division['level0_short'],
            level1Full: $division['level1_full'],
            level1Short: $division['level1_short'],
            level2Full: $division['level2_full'],
            level2Short: $division['level2_short'],
            level3Full: $division['level3_full'],
            level3Short: $division['level3_short'],
            level4Full: $division['level4_full'],
            level4Short: $division['level4_short'],
            level5Full: $division['level5_full'],
            level5Short: $division['level5_short'],
            description: $division['description']
        );

        return $this->divisionRepository->updateDivision($divisionDTO, $divisionId);
    }

    public function deleteDivision(string $level0Full, string $level1Full, string $level2Full): int
    {
        return $this->divisionRepository->deleteDivision($level0Full, $level1Full, $level2Full);
    }

    public function store(array $division): int
    {
        return $this->divisionRepository->store($division);
    }

    public function destroy(int $divisionId): int
    {
        return $this->divisionRepository->destroy($divisionId);
    }
}

<?php

namespace App\Services;

use App\DTO\CreateStatusDTO;
use App\Models\Status;
use App\Repositories\StatusRepository as StatusRepositoryContract;
use App\Services\Contracts\StatusContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class StatusService implements StatusContract
{
    public function __construct(
        private readonly StatusRepositoryContract $statusRepository
    )
    {
    }

    public function getStatuses(): Collection
    {
        return $this->statusRepository->getStatuses();
    }

    public function getAll(): array
    {
        return ['data' => $this->statusRepository->getAll()];
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->statusRepository->getPaginated();
    }

    public function getDivisions(): Collection
    {
        return $this->statusRepository->getStatuses();
    }

    public function getStatusById(int $id): Status
    {
        return $this->statusRepository->getStatusById($id);
    }

    public function createStatus(array $status): bool
    {
        $result = $this->statusRepository->createStatus(
            new CreateStatusDTO(
                letter: $status['letter'],
                description: $status['description'],
                color: $status['color'],
                colorDescription: $status['colorDescription']
            )
        );

        if (!$result) {
            return false;
        }

        return true;
    }

    public function deleteStatus(string $letter, string $color): int
    {
        return $this->statusRepository->deleteStatus($letter, $color);
    }

    public function store(array $status): bool
    {
        return $this->statusRepository->store($status);
    }

    public function destroy(int $statusId): int
    {
        return $this->statusRepository->destroy($statusId);
    }
}

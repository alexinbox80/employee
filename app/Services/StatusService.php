<?php

namespace App\Services;

use App\DTO\CreateStatusDTO;
use App\DTO\UpdateStatusDTO;
use App\Models\Status;
use App\Repositories\StatusRepository as StatusRepositoryContract;
use App\Services\Contracts\StatusContract;
use Illuminate\Database\Eloquent\Collection;

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

    public function getPaginated(): array
    {
        return [
            'data' => $this->statusRepository->getPaginated()
        ];
    }

    public function getDivisions(): Collection
    {
        return $this->statusRepository->getStatuses();
    }

    public function getStatusById(int $id): Status
    {
        return $this->statusRepository->getStatusById($id);
    }

    public function createStatus(array $status): Status
    {
        return $this->statusRepository->createStatus(
            new CreateStatusDTO(
                letter: $status['letter'],
                description: $status['description'] ?? null,
                color: $status['color'],
                colorDescription: $status['color_description'] ?? null
            )
        );
    }

    public function updateStatus(array $status, int $statusId): Status
    {
        $statusDTO = new UpdateStatusDTO(
            letter: $status['letter'],
            description: $status['description'] ?? null,
            color: $status['color'],
            colorDescription: $status['color_description'] ?? null
        );

        return $this->statusRepository->updateStatus($statusDTO, $statusId);
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

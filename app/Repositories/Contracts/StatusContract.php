<?php

namespace App\Repositories\Contracts;

use App\DTO\CreateStatusDTO;
use App\DTO\UpdateStatusDTO;
use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface StatusContract
{
    public function getStatuses(): Collection;
    public function getAll(): Collection;
    public function getPaginated(): LengthAwarePaginator;
    public function getStatusById(int $id): Status;
    public function createStatus(CreateStatusDTO $statusDTO): Status;
    public function updateStatus(UpdateStatusDTO $statusDTO, int $statusId): Status;
    public function deleteStatus(string $letter, string $color): int;
    public function store(array $status): bool;
    public function destroy(int $statusId): int;
}

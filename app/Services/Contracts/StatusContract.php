<?php

namespace App\Services\Contracts;

use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface StatusContract
{
    public function getStatuses(): Collection;
    public function getAll(): array;
    public function getPaginated(): array;
    public function getDivisions(): Collection;
    public function getStatusById(int $id): Status;
    public function createStatus(array $status): Status;
    public function updateStatus(array $status, int $statusId): Status;
    public function deleteStatus(string $letter, string $color): int;
    public function store(array $status): bool;
    public function destroy(int $statusId): int;
}

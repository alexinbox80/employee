<?php

namespace App\Repositories;

use App\DTO\CreateStatusDTO;
use App\DTO\UpdateStatusDTO;
use App\Models\Status;
use App\Repositories\Contracts\StatusContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class StatusRepository implements StatusContract
{
    public function getStatuses(): Collection
    {
        return Status::all();
    }

    public function getAll(): Collection
    {
        return Status::all();
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return Status::paginate(config('pagination.admin.statuses'));
    }

    public function getStatusById(int $id): Status
    {
        return Status::query()->findOrFail($id);
    }

    public function createStatus(CreateStatusDTO $statusDTO): Status
    {
        $status = Status::create([
            'letter' => $statusDTO->letter,
            'description' => $statusDTO->description,
            'color' => $statusDTO->color,
            'color_description' => $statusDTO->colorDescription
        ]);

        return $status->refresh();
    }

    public function updateStatus(UpdateStatusDTO $statusDTO, int $statusId): Status
    {
        $status = Status::find($statusId);
        $status->update([
            'letter' => $statusDTO->letter,
            'description' => $statusDTO->description,
            'color' => $statusDTO->color,
            'color_description' => $statusDTO->colorDescription
        ]);

        return $status->refresh();
    }

    public function deleteStatus(string $letter, string $color): int
    {
        $status = Status::where([
            'letter' => $letter,
            'color' => $color,
            ])->first();
        return $status->delete();
    }

    public function store(array $status): bool
    {
        $statuses = new Status(
            $status
        );

        return $statuses->save();
    }

    public function destroy(int $statusId): int
    {
        return Status::destroy($statusId);
    }
}

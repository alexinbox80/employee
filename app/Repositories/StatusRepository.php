<?php

namespace App\Repositories;

use App\Models\Status;
use App\Repositories\Contracts\StatusContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StatusRepository implements StatusContract
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

    public function createStatus(string $letter, string $description, string $color, string $colorDescription): bool
    {
        $status = Status::create([
            'letter' => $letter,
            'description' => $description,
            'color' => $color,
            'color_description' => $colorDescription
        ]);

        return isset($status);
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

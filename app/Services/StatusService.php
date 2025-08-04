<?php

namespace App\Services;

use App\Repositories\StatusRepository as StatusRepositoryContract;
use App\Services\Contracts\StatusContract;
use Illuminate\Database\Eloquent\Collection;

class StatusService implements StatusContract
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
}

<?php

namespace App\Repositories;

use App\Models\Status;
use App\Repositories\Contracts\StatusContract;
use Illuminate\Database\Eloquent\Collection;

class StatusRepository implements StatusContract
{
    public function getStatuses(): Collection
    {
        return Status::all();
    }
}

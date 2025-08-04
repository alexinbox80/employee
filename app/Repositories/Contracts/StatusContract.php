<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface StatusContract
{
    public function getStatuses(): Collection;
}

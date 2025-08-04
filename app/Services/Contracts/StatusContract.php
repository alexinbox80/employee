<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface StatusContract
{
    public function getStatuses(): Collection;
}

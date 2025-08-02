<?php

namespace App\Repositories\Contracts;

use App\Models\Division;

interface DivisionContract
{
    public function findById(int $id): Division;
}

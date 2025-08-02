<?php

namespace App\Repositories;

use App\Models\Division;
use App\Repositories\Contracts\DivisionContract;

final class DivisionRepository implements DivisionContract
{
    public function findById(int $id): Division
    {
        return Division::query()->findOrFail($id);
    }
}

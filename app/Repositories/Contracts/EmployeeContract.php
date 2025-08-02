<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface EmployeeContract
{
    public function getEmployeesForPage(int $month, int $year): Collection;
}

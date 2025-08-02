<?php

namespace App\Repositories\Contracts;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

interface EmployeeContract
{
    public function getEmployeesForPage(int $month, int $year): Collection;
    public function getEmployeesForPageById(int $divisionId): Collection;
    public function findById(int $id): Employee;
}

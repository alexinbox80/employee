<?php

namespace App\Services\Contracts;

use App\Models\Employee;

interface EmployeeContract
{
    public function index(int $month, int $year): array;
    public function getDivisionById(int $divisionId): array;
    public function findEmployeeById(int $id): Employee;
}

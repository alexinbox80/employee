<?php

namespace App\Services\Contracts;

use App\Models\Employee;
use Illuminate\Http\Request;

interface PageContract
{
    public function index(Request $request): array;
    public function getDivisionById(int $divisionId): array;

    public function findEmployeeById(int $id): Employee;
}

<?php

namespace App\Services\Contracts;

use App\Models\Employee;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface EmployeeContract
{
    public function index(int $month, int $year): array;
    public function indexDocx(int $month, int $year): array;
    public function getDivisionById(int $divisionId): array;
    public function findEmployeeById(int $id): Employee;
    public function getAll(): array;
    public function getPaginated(): LengthAwarePaginator;
    public function getEmployees(): Collection;
    public function getEmployeeById(int $id): Employee;
    public function createEmployee(array $employee): bool;
    public function deleteEmployee(int $divisionId, int $departmentId): int;
    public function store(array $employee): bool;
    public function destroy(int $employeeId): int;
}

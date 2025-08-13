<?php

namespace App\Repositories\Contracts;

use App\DTO\CreateEmployeeDTO;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface EmployeeContract
{
    public function getEmployeesForPage(int $month, int $year): Collection;
    public function getEmployeesForDocx(int $month, int $year): Collection;
    public function getEmployeesForPageById(int $divisionId): Collection;
    public function findById(int $id): Employee;
    public function getAll(): Collection;
    public function getPaginated(): LengthAwarePaginator;
    public function getEmployees(): Collection;
    public function getEmployeesByDepartmentId(int $departmentId): Collection;
    public function getEmployeesByDivisionId(int $divisionId): Collection;
    public function getEmployeeById(int $id): Employee;
    public function createEmployee(CreateEmployeeDTO $employeeDTO): bool;
    public function deleteEmployee(int $divisionId, int $departmentId): int;
    public function store(array $employee): bool;
    public function destroy(int $employeeId): int;
}

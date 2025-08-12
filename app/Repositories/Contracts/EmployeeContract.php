<?php

namespace App\Repositories\Contracts;

use App\Models\Employee;
use DateTime;
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
    public function createEmployee(
        int $divisionId,
        int $departmentId,
        bool $isShown,
        string $lastName,
        string $firstName,
        string $middleName,
        DateTime $birthDate,
        string $sex,
        string $position,
        string $email,
        string $homePhone,
        string $workPhone,
        string $mobilePhone,
        string $address,
        int $room
    ): bool;
    public function deleteEmployee(int $divisionId, int $departmentId): int;
    public function store(array $employee): bool;
    public function destroy(int $employeeId): int;
}

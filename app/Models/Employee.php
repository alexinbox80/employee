<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

final class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        //подразделение
        'division_id',
        //отдел
        'department_id',
        'is_shown',
        'last_name',
        'first_name',
        'middle_name',
        'birth_date',
        'sex',
        'position',
        'email',
        'home_phone',
        'work_phone',
        'mobile_phone',
        'address',
        'room'
    ];

    protected $with = [
        'division',
        'department',
        'schedules'
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getDivisionId(): int
    {
        return $this->division_id;
    }

    public function getDepartmentId(): int
    {
        return $this->department_id;
    }

    public function getIsShown(): bool
    {
        return $this->is_shown;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getMiddleName(): string
    {
        return $this->middle_name;
    }

    public function getBirthDate(): string
    {
        return $this->birth_date;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getHomePhone(): ?string
    {
        return $this->home_phone;
    }

    public function getWorkPhone(): ?string
    {
        return $this->work_phone;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobile_phone;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getRoom(): ?int
    {
        return $this->room;
    }

    //Relations
    public function division(): HasOne
    {
        return $this->hasOne(Division::class, 'id', 'division_id');
    }

    public function department(): HasOne
    {
        return $this->hasOne(Division::class, 'id', 'department_id');
    }

    public function schedules(): HasMany
    {;
        return $this->hasMany(Schedule::class);
    }
}

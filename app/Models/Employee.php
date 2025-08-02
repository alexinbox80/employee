<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
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

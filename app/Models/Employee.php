<?php

namespace App\Models;

use Carbon\Carbon;
use DeepCopy\TypeFilter\ShallowCopyFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'schedules'
    ];

    //Relations
    public function division(): HasOne
    {
        return $this->hasOne(Division::class, 'id', 'division_id');
    }

    public function schedules(): HasMany
    {
        //$date = Carbon::now('Europe/Moscow')->toDateString();
        $dateM = Carbon::now('Europe/Moscow')->format('m');
        $dateY = Carbon::now('Europe/Moscow')->format('Y');
        $dateL = $dateY . '-' . $dateM . '-01';
        $dateR = $dateY . '-' . $dateM . '-31';
        //dd($date);

        return $this->hasMany(Schedule::class)->where('date', '>=', $dateL)->where('date', '<=', $dateR);
    }
}

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
        'division_id',
        'first_name',
        'last_name',
        'middle_name',
        'position',
        'email',
        'phone',
        'address',
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
        $date = Carbon::now('Europe/Moscow')->toDateString();

        return $this->hasMany(Schedule::class)->where('date', $date);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'employee_id',
        'status_id',
        'date',
        'description'
    ];

    protected $with = [
        'status'
    ];

    public static function dateConvert(string $date): string
    {
        return date('Y-m-d', strtotime($date));
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}

/*

Employee::with(['division', 'schedules'])->whereHas('schedules', function($query) {
    return $query->with('status')->where('date', '2025-07-25');
})->get();

Employee::whereHas('schedules', function($query) {
    return $query->where('date', '2025-07-25');
})->get();

*/

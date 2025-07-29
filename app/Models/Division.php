<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Division extends Model
{
    /** @use HasFactory<\Database\Factories\DivisionFactory> */
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'level0_full',
        'level0_short',
        'level1_full',
        'level1_short',
        'level2_full',
        'level2_short',
        'level3_full',
        'level3_short',
        'level4_full',
        'level4_short',
        'level5_full',
        'level5_short',
        'description'
    ];

    //Relations
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

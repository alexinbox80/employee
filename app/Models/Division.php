<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'employee_id',
        'level0',
        'level1',
        'level2',
        'level3',
        'level4',
        'level5',
        'position',
        'description'
    ];

    //Relations
    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class,
            'employee_id', 'id');
    }
}

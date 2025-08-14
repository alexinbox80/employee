<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

final class Division extends Model
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getLevel0Full(): string
    {
        return $this->level0_full;
    }

    public function getLevel0Short(): ?string
    {
        return $this->level0_short;
    }

    public function getLevel1Full(): string
    {
        return $this->level1_full;
    }

    public function getLevel1Short(): ?string
    {
        return $this->level1_short;
    }

    public function getLevel2Full(): ?string
    {
        return $this->level2_full;
    }

    public function getLevel2Short(): ?string
    {
        return $this->level2_short;
    }

    public function getLevel3Full(): ?string
    {
        return $this->level3_full;
    }

    public function getLevel3Short(): ?string
    {
        return $this->level3_short;
    }

    public function getLevel4Full(): ?string
    {
        return $this->level4_full;
    }

    public function getLevel4Short(): ?string
    {
        return $this->level4_short;
    }

    public function getLevel5Full(): ?string
    {
        return $this->level5_full;
    }

    public function getLevel5Short(): ?string
    {
        return $this->level5_short;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    //Relations
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chair extends Model
{
    use HasFactory;

    protected $fillable = [ //место
        'hall_id',
        'row',
        'place',
        'type'
    ];

    public function hall(): BelongsTo //принадлежит залу
    {
        return $this->belongsTo(Hall::class);
    }

    /**
     * Получить билеты на это кресло.
     */
    public function tickets(): HasMany //имеет много билетов
    {
        return $this->hasMany(Ticket::class);
    }
}

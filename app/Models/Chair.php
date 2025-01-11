<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chair extends Model
{
    use HasFactory;

    protected $fillable = [
        'hall_id',
        'row',
        'place',
        'type'
    ];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);  //Определяет метод hall, который возвращает отношение BelongsTo к модели Hall.
    }

    /**
     * Получить билеты на это кресло.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'hall_id',
        'start',
    ];

//    protected $table = 'seances';

    public function hall(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    public function movie(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Получить билеты, проданные на этот сеанс.
     */
    // public function tickets(): HasMany
    // {
    //     return $this->hasMany(Ticket::class);
    // }
}

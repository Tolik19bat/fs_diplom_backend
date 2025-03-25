<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seance extends Model
{
    use HasFactory;

    protected $fillable = [ // сеанс
        'movie_id',
        'hall_id',
        'start',
    ];

    protected $casts = [
        'hall_id' => 'integer',
        'movie_id' => 'integer',
        'start' => 'datetime',
    ];
    
    // Аксессор для форматирования времени без ведущего нуля
    public function getStartAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('G:i');
    }

//    protected $table = 'seances';

    public function hall(): BelongsTo //принадлежит залу
    {
        return $this->belongsTo(Hall::class);
    }

    public function movie(): BelongsTo //принадлежит фильму
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Получить билеты, проданные на этот сеанс.
     */
    public function tickets(): HasMany //имеет много билетов
    {
        return $this->hasMany(Ticket::class);
    }
}

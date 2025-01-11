<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [ //билет
        'date',
        'seance_id',
        'chair_id',
    ];

    /**
     * Получить сеанс, связанный с билетом.
     */
    public function seance(): HasOne //имеет один сеанс
    {
        return $this->hasOne(Seance::class);
    }

    /**
     * Получить кресло, указанное в билете.
     */
    public function chair(): BelongsTo //принадлежит месту
    {
        return $this->belongsTo(Chair::class);
    }
}

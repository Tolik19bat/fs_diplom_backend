<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'seance_id',
        'chair_id',
    ];

    /**
     * Получить сеанс, связанный с билетом.
     */
    public function seance(): HasOne
    {
        return $this->hasOne(Seance::class);
    }

    /**
     * Получить кресло, указанное в билете.
     */
    public function chair(): BelongsTo
    {
        return $this->belongsTo(Chair::class);
    }
}

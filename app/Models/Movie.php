<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [ //фильм
        'title',
        'duration',
        'poster_url',
        'country',
        'description',
        'start_date',
        'end_date',
    ];
    
    public function seances(): HasMany //имеет много сеансов
    {
        return $this->hasMany(Seance::class);
    }
}

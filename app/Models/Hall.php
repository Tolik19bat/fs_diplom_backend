<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [ //залл
        'name',
        'ticket_price',
        'vip_ticket_price',
        'sales'
    ];

    public function chairs(): HasMany //имеет много мест
    {
        return $this->hasMany(Chair::class);
    }

    public function seances(): HasMany //имеет много сеансов
    {
        return $this->hasMany(Seance::class);
    }
}

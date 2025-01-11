<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ticket_price',
        'vip_ticket_price',
        'sales'
    ];

    public function chairs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Chair::class);
    }

    public function seances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Seance::class);
    }
}

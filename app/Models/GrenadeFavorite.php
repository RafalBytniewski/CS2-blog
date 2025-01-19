<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrenadeFavorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'grenade_id',
        'favorite'
    ];

    public function users(): BelongsTo
{
    return $this->belongsTo(User::class);
}

public function grenades(): BelongsTo
{
    return $this->belongsTo(Grenade::class);
}
}

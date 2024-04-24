<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrenadeVote extends Model
{
    use HasFactory;

    /**
 * The attributes that are mass assignable.
 *
 * @var array<int, string>
 */
protected $fillable = [
    'id',
    'user_id',
    'grenade_id'
];
public function users(): bBlongsTo
{
    return $this->belongsTo(User::class);
}

public function grenades(): BelongsTo
{
    return $this->belongsTo(User::class);
}
}

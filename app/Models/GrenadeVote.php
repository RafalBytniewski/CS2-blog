<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    'grenade_id',
    'vote_type'
];
public static function calculateVotes($grenadeId)
{
    return DB::table('grenade_votes')
        ->where('grenade_id', $grenadeId)
        ->sum('vote_type');
}
public function users(): BelongsTo
{
    return $this->belongsTo(User::class);
}

public function grenades(): BelongsTo
{
    return $this->belongsTo(Grenade::class);
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grenade extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'map_id',
        'describtion',
        'team',
        'type',
        'visibility',
        'area_from_id',
        'area_to_id',
        'callout_from_id',
        'callout_to_id'
    ];
    
    public function grenadeImages(): HasMany
    {
        return $this->hasMany(GrenadeImage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function map(): BelongsTo
    {
        return $this->belongsTo(Map::class);
    }

    public function calloutFrom()
    {
        return $this->belongsTo(Callout::class, 'callout_from_id');
    }

    public function calloutTo()
    {
        return $this->belongsTo(Callout::class, 'callout_to_id');
    }
    public function areaFrom()
    {
        return $this->belongsTo(Area::class, 'area_from_id');
    }
    public function areaTo()
    {
        return $this->belongsTo(Area::class, 'area_to_id');
    }
    public function votes(): HasMany
    {
        return $this->hasMany(GrenadeVote::class);
    }
}

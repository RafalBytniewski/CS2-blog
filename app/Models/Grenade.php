<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grenade extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'describtion',
        'image_path',
        'team',
        'type',
        'user_id',
        'map_id',
        'callout_from_id',
        'callout_to_id'
    ];
    
    protected $casts = [
        'image_path' => 'array'
    ];

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
}

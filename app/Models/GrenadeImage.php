<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class GrenadeImage extends Model
{
    use HasFactory;
    
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'grenade_id',
        'path',
        'position',
        'type'
    ];
    public function grenades(): BelongsTo
    {
        return $this->belongsTo(Grenade::class);
    }

}

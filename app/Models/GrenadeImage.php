<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'path'
    ];
    public function grenades(): BelongsTo
    {
        return $this->belongsTo(Grenade::class);
    }

}

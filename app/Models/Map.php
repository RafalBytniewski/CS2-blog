<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;



class Map extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'describtion',
        'active',
        'image_path'
    ];

    public function grenades(): HasMany
    {
        return $this->hasMany(Grenade::class);
    }

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
    }

}

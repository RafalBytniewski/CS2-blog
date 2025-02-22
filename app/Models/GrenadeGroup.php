<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrenadeGroup extends Model
{
    use HasFactory;

    protected $fillabe = [
        'id',
        'map_id',
        'user_id',
        'name',
        'description',
    ];

    public function grenades()
    {
        return $this-> belongsToMany(Grenade::class, 'grenade_group_item');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }
}

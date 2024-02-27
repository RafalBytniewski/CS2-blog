<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callout extends Model
{
    use HasFactory;

    /**
 * The attributes that are mass assignable.
 *
 * @var array<int, string>
 */
protected $fillable = [
    'name',
    'area_id'
];

public function areas(): BelongsTo
{
    return $this->belongsTo(Area::class);
}
}

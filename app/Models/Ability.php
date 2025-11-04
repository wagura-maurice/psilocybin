<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ability extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        '_slug',
        'description',
        '_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        '_status' => 'integer',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        '_status' => 0, // 0 = inactive, 1 = active
    ];

    /**
     * The roles that belong to the ability.
     */
    /**
     * The roles that belong to the ability.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'ability_role')
            ->withTimestamps()
            ->withPivot('created_at', 'updated_at');
    }
}

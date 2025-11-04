<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use App\Models\Ability;

class Role extends Model
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
     * The users that belong to the role.
     */
    /**
     * The users that belong to the role.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user')
            ->withTimestamps()
            ->withPivot('created_at', 'updated_at');
    }

    /**
     * The abilities that belong to the role.
     */
    /**
     * The abilities that belong to the role.
     */
    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(Ability::class, 'ability_role')
            ->withTimestamps()
            ->withPivot('created_at', 'updated_at');
    }

    /**
     * Check if the role has a specific ability.
     */
    public function hasAbility(string $ability): bool
    {
        return $this->abilities()->where('name', $ability)->exists();
    }
}

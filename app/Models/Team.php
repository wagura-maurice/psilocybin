<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
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
        'user_id',
        'name',
        '_slug',
        'description',
        'personal_team',
        '_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'personal_team' => 'boolean',
        '_status' => 'integer',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'personal_team' => false,
        '_status' => 0, // 0 = inactive, 1 = active
    ];

    /**
     * Get the owner of the team.
     */
    /**
     * Get the owner of the team.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all the users that belong to the team.
     */
    /**
     * Get all the users that belong to the team.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user')
            ->withPivot(['role', 'created_at', 'updated_at'])
            ->withTimestamps()
            ->using(TeamUser::class);
    }

    /**
     * Determine if the given user belongs to the team.
     */
    /**
     * Determine if the given user belongs to the team.
     */
    public function hasUser(User $user): bool
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }

    /**
     * Get the user's role on the team.
     */
    public function getUserRole(User $user): ?string
    {
        $teamUser = $this->users()->where('user_id', $user->id)->first();
        
        return $teamUser ? $teamUser->pivot->role : null;
    }

    /**
     * Get the team's status as a string.
     */
    public function getStatusAttribute(): string
    {
        return $this->_status === 1 ? 'active' : 'inactive';
    }

    /**
     * Scope a query to only include active teams.
     */
    public function scopeActive($query)
    {
        return $query->where('_status', 1);
    }

    /**
     * Scope a query to only include inactive teams.
     */
    public function scopeInactive($query)
    {
        return $query->where('_status', 0);
    }
}

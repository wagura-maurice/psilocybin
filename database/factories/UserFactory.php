<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\Team;
use App\Models\Role;
use App\Models\Biometric;
use App\Models\Ability;
use Database\Factories\ProfileFactory;
use Database\Factories\TeamFactory;
use Database\Factories\BiometricFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Configure the model factory.
     */
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user): void {
            $this->ensureUserHasProfile($user);
            $this->ensureUserHasTeam($user);
        });
    }

    /**
     * Ensure the user has a profile.
     */
    protected function ensureUserHasProfile(User $user): void
    {
        if (!$user->profile) {
            ProfileFactory::new()
                ->for($user)
                ->create(['user_id' => $user->id]);
        }
    }

    /**
     * Ensure the user has a team and necessary associations.
     */
    protected function ensureUserHasTeam(User $user): void
    {
        if ($user->ownedTeams()->exists()) {
            return;
        }

        $team = TeamFactory::new()
            ->for($user, 'owner')
            ->create([
                'name' => "{$user->name}'s Team",
                '_slug' => Str::slug("{$user->name}-team"),
                'personal_team' => false,
                '_status' => 1, // 1 = active
            ]);

        $user->update(['current_team_id' => $team->id]);
        
        $this->setupTeamAbilities($team);
        $this->ensureUserHasBiometric($user);
    }

    /**
     * Set up user role abilities.
     */
    protected function setupTeamAbilities(Team $team): void
    {
        // Get the user from the team
        $user = $team->owner;
        
        // Get the default role (e.g., 'admin' or 'member')
        $role = Role::where('_slug', 'admin')->first();
        
        if ($role) {
            // Assign the role to the user
            $user->roles()->syncWithoutDetach([$role->id]);
            
            // If the role has abilities, they will be available through the role-ability relationship
        }
    }

    /**
     * Ensure the user has a biometric record.
     */
    protected function ensureUserHasBiometric(User $user): void
    {
        if ($user->biometric) {
            return;
        }

        BiometricFactory::new()
            ->for($user)
            ->create([
                'user_id' => $user->id,
                '_status' => Biometric::STATUS_VERIFIED,
            ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

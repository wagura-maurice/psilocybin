<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Roles → Abilities → Pivot
        $this->call([
            RolesTableSeeder::class,
            AbilitiesTableSeeder::class,
            AbilityRoleTableSeeder::class,
        ]);

        // 2. Create key users and assign real roles using _slug
        // Only create users for roles that exist in the RolesTableSeeder
        $userRoles = [
            'Super Administrator' => ['email' => 'superadmin@psilocybin.org', 'role' => 'super_administrator'],
            'General Manager' => ['email' => 'gm@psilocybin.org', 'role' => 'general_manager'],
            'Finance Manager' => ['email' => 'finance@psilocybin.org', 'role' => 'finance_manager'],
            'Operations Manager' => ['email' => 'operations@psilocybin.org', 'role' => 'operations_manager'],
            'Restaurant Manager' => ['email' => 'restaurant@psilocybin.org', 'role' => 'restaurant_manager'],
            'Bar Manager' => ['email' => 'bar@psilocybin.org', 'role' => 'bar_manager'],
            'Executive Chef' => ['email' => 'chef@psilocybin.org', 'role' => 'executive_chef'],
            'Accommodation Manager' => ['email' => 'accommodation@psilocybin.org', 'role' => 'accommodation_manager'],
            'HR Manager' => ['email' => 'hr@psilocybin.org', 'role' => 'hr_manager'],
            'Security Manager' => ['email' => 'security@psilocybin.org', 'role' => 'security_manager'],
            'Security Guard' => ['email' => 'guard@psilocybin.org', 'role' => 'security_guard'],
            'Front Desk Agent' => ['email' => 'frontdesk@psilocybin.org', 'role' => 'front_desk_agent'],
            'Server' => ['email' => 'server@psilocybin.org', 'role' => 'server'],
            'Bartender' => ['email' => 'bartender@psilocybin.org', 'role' => 'bartender'],
            'Housekeeping' => ['email' => 'housekeeping@psilocybin.org', 'role' => 'housekeeping']
        ];

        foreach ($userRoles as $name => $data) {
            $this->createUser($name, $data['email'], $data['role']);
        }
    }

    /**
     * Create a user, assign a role, and create a team.
     */
    private function createUser(string $name, string $email, string $roleSlug): User
    {
        // Create the user
        $user = User::factory()->create([
            'name'  => $name,
            'email' => $email,
        ]);

        // Assign the role
        $user->assignRole($roleSlug);

        // Create a team for the user if they don't have one
        if ($user->ownedTeams()->count() === 0) {
            $teamName = $name . "'s Team";
            $team = $user->ownedTeams()->create([
                '_uuid' => (string) \Illuminate\Support\Str::uuid(),
                'name' => $teamName,
                '_slug' => \Illuminate\Support\Str::slug($teamName),
                'description' => 'Team for ' . $name,
                'personal_team' => false,
                '_status' => 1, // Active
            ]);

            // Attach the user to the team as admin
            $user->teams()->attach($team->id, ['role' => 'admin']);
            
            // Set the user's current team
            $user->current_team_id = $team->id;
            $user->save();

            // Grant all abilities to the team owner
            $abilities = \App\Models\Ability::all();
            $team->abilities()->sync($abilities->pluck('id'));
        }

        return $user;
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbilityRoleTableSeeder extends Seeder
{
    /**
     * Assign abilities to roles based on business logic.
     */
    public function run(): void
    {
        // Clear pivot table in a database-agnostic way
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('ability_role')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } else {
            // For SQLite and other databases
            DB::table('ability_role')->delete();
            // SQLite doesn't use sequences for pivot tables, so no need to reset sequence
        }

        // Cache role & ability IDs for performance
        $roles = DB::table('roles')->pluck('id', '_slug');
        $abilities = DB::table('abilities')->pluck('id', '_slug');

        $assignments = [];

        // ────────────────────── SUPER ADMINISTRATOR ──────────────────────
        $superAdmin = $roles['super_administrator'];
        foreach ($abilities as $abilityId) {
            $assignments[] = [
                'role_id'     => $superAdmin,
                'ability_id'  => $abilityId,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── GENERAL MANAGER ─────────────────────────
        $generalManager = $roles['general_manager'];
        $gmAbilities = [
            'view_dashboard', 'view_users', 'view_reports', 'export_data',
            'manage_reservations', 'manage_menu', 'manage_room_status',
            'manage_events', 'process_payments', 'manage_attendance',
            'log_maintenance', 'monitor_cctv'
        ];
        foreach ($gmAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $generalManager,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── FINANCE MANAGER ─────────────────────────
        $financeManager = $roles['finance_manager'];
        $financeAbilities = [
            'view_reports', 'export_data', 'process_payments', 'process_payroll'
        ];
        foreach ($financeAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $financeManager,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── RESTAURANT MANAGER ─────────────────────
        $restaurantManager = $roles['restaurant_manager'];
        $restaurantAbilities = [
            'manage_reservations', 'take_orders', 'process_payments',
            'manage_menu', 'view_reports'
        ];
        foreach ($restaurantAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $restaurantManager,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── BAR MANAGER ────────────────────────────
        $barManager = $roles['bar_manager'];
        $barAbilities = [
            'serve_drinks', 'manage_bar_inventory', 'process_payments', 'view_reports'
        ];
        foreach ($barAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $barManager,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── EXECUTIVE CHEF ──────────────────────────
        $execChef = $roles['executive_chef'];
        $chefAbilities = [
            'manage_menu', 'manage_recipes', 'prepare_food', 'manage_bar_inventory'
        ];
        foreach ($chefAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $execChef,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── ACCOMMODATION MANAGER ───────────────────
        $accommodationManager = $roles['accommodation_manager'];
        $accommodationAbilities = [
            'check_in_guests', 'check_out_guests', 'manage_room_status',
            'manage_reservations', 'process_payments'
        ];
        foreach ($accommodationAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $accommodationManager,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── FRONT DESK AGENT ────────────────────────
        $frontDesk = $roles['front_desk_agent'];
        $frontDeskAbilities = [
            'check_in_guests', 'check_out_guests', 'manage_reservations'
        ];
        foreach ($frontDeskAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $frontDesk,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── SERVER / WAITER ────────────────────────
        $server = $roles['server'];
        $serverAbilities = ['take_orders', 'process_payments'];
        foreach ($serverAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $server,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── BARTENDER ───────────────────────────────
        $bartender = $roles['bartender'];
        $bartenderAbilities = ['serve_drinks'];
        foreach ($bartenderAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $bartender,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── LINE COOK ───────────────────────────────
        $lineCook = $roles['line_cook'];
        $cookAbilities = ['prepare_food'];
        foreach ($cookAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $lineCook,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── HOUSEKEEPING ───────────────────────────
        $housekeeping = $roles['housekeeping'];
        $housekeepingAbilities = ['manage_room_status'];
        foreach ($housekeepingAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $housekeeping,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── VALET ATTENDANT ────────────────────────
        $valet = $roles['valet_attendant'];
        $valetAbilities = ['park_vehicles'];
        foreach ($valetAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $valet,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── STORE KEEPER ───────────────────────────
        $storeKeeper = $roles['store_keeper'];
        $storeAbilities = ['receive_stock', 'issue_stock'];
        foreach ($storeAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $storeKeeper,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── SECURITY GUARD ─────────────────────────
        $security = $roles['security_guard'];
        $securityAbilities = ['control_access', 'monitor_cctv'];
        foreach ($securityAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $security,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ────────────────────── HR MANAGER ─────────────────────────────
        $hrManager = $roles['hr_manager'];
        $hrAbilities = [
            'manage_attendance', 'process_payroll', 'create_users', 'edit_users'
        ];
        foreach ($hrAbilities as $slug) {
            $assignments[] = [
                'role_id'     => $hrManager,
                'ability_id'  => $abilities[$slug],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // Insert in chunks
        foreach (array_chunk($assignments, 50) as $chunk) {
            DB::table('ability_role')->insert($chunk);
        }

        $this->command->info('Successfully assigned abilities to roles!');
    }
}
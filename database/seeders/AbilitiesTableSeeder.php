<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Ability;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing abilities in a database-agnostic way
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('abilities')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } else {
            // For SQLite and other databases
            DB::table('abilities')->delete();
            if (DB::connection()->getDriverName() === 'sqlite') {
                DB::statement('DELETE FROM sqlite_sequence WHERE name = "abilities"');
            }
        }

        $abilities = [
            // ────────────────────── SYSTEM & CORE ──────────────────────
            [
                'name'        => 'Manage System',
                '_slug'       => 'manage_system',
                'description' => 'Full access to all system settings, users, roles, and abilities.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'View Dashboard',
                '_slug'       => 'view_dashboard',
                'description' => 'Access to the main analytics dashboard.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── USER MANAGEMENT ───────────────────
            [
                'name'        => 'Create Users',
                '_slug'       => 'create_users',
                'description' => 'Add new staff or customer accounts.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Edit Users',
                '_slug'       => 'edit_users',
                'description' => 'Modify user profiles, roles, and permissions.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Delete Users',
                '_slug'       => 'delete_users',
                'description' => 'Permanently remove user accounts.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'View Users',
                '_slug'       => 'view_users',
                'description' => 'See list of all users and their details.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── ROLE & ABILITY MANAGEMENT ─────────
            [
                'name'        => 'Manage Roles',
                '_slug'       => 'manage_roles',
                'description' => 'Create, edit, and assign roles.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Manage Abilities',
                '_slug'       => 'manage_abilities',
                'description' => 'Create, edit, and assign permissions (abilities).',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── RESTAURANT OPERATIONS ─────────────
            [
                'name'        => 'Manage Reservations',
                '_slug'       => 'manage_reservations',
                'description' => 'Create, update, and cancel table bookings.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Take Orders',
                '_slug'       => 'take_orders',
                'description' => 'Record customer food and drink orders.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Process Payments',
                '_slug'       => 'process_payments',
                'description' => 'Handle cash, card, and mobile payments.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Manage Menu',
                '_slug'       => 'manage_menu',
                'description' => 'Add, edit, or remove menu items and prices.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── BAR OPERATIONS ────────────────────
            [
                'name'        => 'Serve Drinks',
                '_slug'       => 'serve_drinks',
                'description' => 'Prepare and serve alcoholic and non-alcoholic beverages.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Manage Bar Inventory',
                '_slug'       => 'manage_bar_inventory',
                'description' => 'Track liquor, mixers, and bar supplies.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── KITCHEN OPERATIONS ────────────────
            [
                'name'        => 'Prepare Food',
                '_slug'       => 'prepare_food',
                'description' => 'Cook and plate dishes according to recipes.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Manage Recipes',
                '_slug'       => 'manage_recipes',
                'description' => 'Create and update standard operating recipes.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── ACCOMMODATION ─────────────────────
            [
                'name'        => 'Check In Guests',
                '_slug'       => 'check_in_guests',
                'description' => 'Register arriving guests and assign rooms.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Check Out Guests',
                '_slug'       => 'check_out_guests',
                'description' => 'Process departure and finalize bills.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Manage Room Status',
                '_slug'       => 'manage_room_status',
                'description' => 'Mark rooms as clean, dirty, occupied, or maintenance.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── TOURS & TRANSPORT ─────────────────
            [
                'name'        => 'Book Tours',
                '_slug'       => 'book_tours',
                'description' => 'Schedule and confirm guest excursions.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Drive Guests',
                '_slug'       => 'drive_guests',
                'description' => 'Operate shuttle or tour vehicles safely.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── CAR WASH & VALET ──────────────────
            [
                'name'        => 'Wash Vehicles',
                '_slug'       => 'wash_vehicles',
                'description' => 'Clean guest and staff vehicles.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Park Vehicles',
                '_slug'       => 'park_vehicles',
                'description' => 'Valet park and retrieve guest cars.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── INVENTORY & PROCUREMENT ───────────
            [
                'name'        => 'Receive Stock',
                '_slug'       => 'receive_stock',
                'description' => 'Accept and verify incoming supplies.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Issue Stock',
                '_slug'       => 'issue_stock',
                'description' => 'Distribute items from storage to departments.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Adjust Inventory',
                '_slug'       => 'adjust_inventory',
                'description' => 'Correct stock levels due to damage, loss, or audit.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── FINANCE & REPORTING ───────────────
            [
                'name'        => 'View Reports',
                '_slug'       => 'view_reports',
                'description' => 'Access sales, expense, and performance reports.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Export Data',
                '_slug'       => 'export_data',
                'description' => 'Download data in CSV, PDF, or Excel.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── HR & PAYROLL ──────────────────────
            [
                'name'        => 'Manage Attendance',
                '_slug'       => 'manage_attendance',
                'description' => 'Clock in/out staff and track working hours.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Process Payroll',
                '_slug'       => 'process_payroll',
                'description' => 'Calculate and distribute employee salaries.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── MAINTENANCE ───────────────────────
            [
                'name'        => 'Log Maintenance',
                '_slug'       => 'log_maintenance',
                'description' => 'Report and track repair requests.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Perform Repairs',
                '_slug'       => 'perform_repairs',
                'description' => 'Fix plumbing, electrical, or structural issues.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── SECURITY ──────────────────────────
            [
                'name'        => 'Monitor CCTV',
                '_slug'       => 'monitor_cctv',
                'description' => 'Watch live feeds and review footage.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Control Access',
                '_slug'       => 'control_access',
                'description' => 'Grant or deny entry to restricted areas.',
                '_status'     => Ability::ACTIVE
            ],

            // ────────────────────── MARKETING & SALES ─────────────────
            [
                'name'        => 'Send Promotions',
                '_slug'       => 'send_promotions',
                'description' => 'Email or SMS marketing campaigns to guests.',
                '_status'     => Ability::ACTIVE
            ],
            [
                'name'        => 'Manage Events',
                '_slug'       => 'manage_events',
                'description' => 'Plan and promote club nights, dinners, or tours.',
                '_status'     => Ability::ACTIVE
            ],
        ];

        // Insert in chunks
        foreach (array_chunk($abilities, 20) as $chunk) {
            DB::table('abilities')->insert($chunk);
        }

        $this->command->info('Successfully seeded ' . count($abilities) . ' abilities!');
    }
}
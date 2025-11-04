<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing roles in a database-agnostic way
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('roles')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } else {
            // For SQLite and other databases
            DB::table('roles')->delete();
            if (DB::connection()->getDriverName() === 'sqlite') {
                DB::statement('DELETE FROM sqlite_sequence WHERE name = "roles"');
            }
        }

        $roles = [
            // ────────────────────── SYSTEM & EXECUTIVE ──────────────────────
            [
                'name'        => 'Super Administrator',
                '_slug'       => 'super_administrator',
                'description' => 'Full system access – can do everything.',
                '_hierarchy_matrix_level' => 100,
                '_status'     => Role::ACTIVE
            ],
            [
                'name'        => 'General Manager',
                '_slug'       => 'general_manager',
                'description' => 'Oversees the entire business location and all departments.',
                '_hierarchy_matrix_level' => 90,
                '_status'     => Role::ACTIVE
            ],
            [
                'name'        => 'Operations Manager',
                '_slug'       => 'operations_manager',
                'description' => 'Handles day-to-day operational coordination across all services.',
                '_hierarchy_matrix_level' => 80,
                '_status'     => Role::ACTIVE
            ],
            [
                'name'        => 'Finance Manager',
                '_slug'       => 'finance_manager',
                'description' => 'Manages accounting, invoicing, payroll and financial reporting.',
                '_hierarchy_matrix_level' => 80,
                '_status'     => Role::ACTIVE
            ],

            // ────────────────────── CLUB / ENTERTAINMENT ───────────────────
            [
                'name'        => 'Club Manager',
                '_slug'       => 'club_manager',
                'description' => 'Runs club events, DJ bookings, lighting & sound.',
                '_hierarchy_matrix_level' => 70,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Event Host',
                '_slug'       => 'event_host',
                'description' => 'Manages event stages, lighting and sound.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Waiter',
                '_slug'       => 'waiter',
                'description' => 'Male waiter Serves food and drinks.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Waitress',
                '_slug'       => 'waitress',
                'description' => 'Female waiter Serves food and drinks.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Disk Jockey',
                '_slug'       => 'disk_jockey',
                'description' => 'Performs live music sets in the club.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Performer',
                '_slug'       => 'performer',
                'description' => 'Performs live music sets in the club.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Bouncer',
                '_slug'       => 'bouncer',
                'description' => 'Ensures safety and enforces club entry rules.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── RESTAURANT ─────────────────────────────
            [
                'name'        => 'Restaurant Manager',
                '_slug'       => 'restaurant_manager',
                'description' => 'Supervises dining room, staff and customer experience.',
                '_hierarchy_matrix_level' => 70,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Maître d’Hôtel',
                '_slug'       => 'maitre_d_hotel',
                'description' => 'Manages reservations, seating and front-of-house flow.',
                '_hierarchy_matrix_level' => 60,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Host/Hostess',
                '_slug'       => 'host_hostess',
                'description' => 'Greets guests, handles bookings and seats tables.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Server',
                '_slug'       => 'server',
                'description' => 'Takes orders, serves food & drinks.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Food Runner',
                '_slug'       => 'food_runner',
                'description' => 'Delivers dishes from kitchen to tables.',
                '_hierarchy_matrix_level' => 30,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Busser',
                '_slug'       => 'busser',
                'description' => 'Clears tables, resets settings, assists servers.',
                '_hierarchy_matrix_level' => 30,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── BAR ───────────────────────────────────
            [
                'name'        => 'Bar Manager',
                '_slug'       => 'bar_manager',
                'description' => 'Oversees bar inventory, staff and beverage program.',
                '_hierarchy_matrix_level' => 70,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Head Bartender',
                '_slug'       => 'head_bartender',
                'description' => 'Creates cocktails, trains bartenders.',
                '_hierarchy_matrix_level' => 60,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Bartender',
                '_slug'       => 'bartender',
                'description' => 'Prepares and serves drinks.',
                '_hierarchy_matrix_level' => 50,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Barback',
                '_slug'       => 'barback',
                'description' => 'Restocks bar, cleans glassware, assists bartenders.',
                '_hierarchy_matrix_level' => 30,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Sommelier',
                '_slug'       => 'sommelier',
                'description' => 'Curates wine list, advises guests, manages cellar.',
                '_hierarchy_matrix_level' => 60,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── KITCHEN ───────────────────────────────
            [
                'name'        => 'Executive Chef',
                '_slug'       => 'executive_chef',
                'description' => 'Designs menus, oversees all culinary operations.',
                '_hierarchy_matrix_level' => 80,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Head Chef',
                '_slug'       => 'head_chef',
                'description' => 'Runs the kitchen brigade on a daily basis.',
                '_hierarchy_matrix_level' => 70,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Sous Chef',
                '_slug'       => 'sous_chef',
                'description' => 'Second-in-command, assists head chef.',
                '_hierarchy_matrix_level' => 60,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Pastry Chef',
                '_slug'       => 'pastry_chef',
                'description' => 'Creates desserts, breads and pastries.',
                '_hierarchy_matrix_level' => 60,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Line Cook',
                '_slug'       => 'line_cook',
                'description' => 'Works a specific station (grill, sauté, etc.).',
                '_hierarchy_matrix_level' => 50,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Prep Cook',
                '_slug'       => 'prep_cook',
                'description' => 'Chops, marinates, prepares mise en place.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── ACCOMMODATION / ROOMS ──────────────────
            [
                'name'        => 'Accommodation Manager',
                '_slug'       => 'accommodation_manager',
                'description' => 'Supervises rooms, housekeeping and guest services.',
                '_hierarchy_matrix_level' => 70,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Front Desk Agent',
                '_slug'       => 'front_desk_agent',
                'description' => 'Handles check-in/out, guest inquiries.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Housekeeping',
                '_slug'       => 'housekeeping',
                'description' => 'Cleans guest rooms and public areas.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Concierge',
                '_slug'       => 'concierge',
                'description' => 'Arranges tours, transport, special requests.',
                '_hierarchy_matrix_level' => 50,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── TOURS & TRANSPORT ─────────────────────
            [
                'name'        => 'Tour Manager',
                '_slug'       => 'tour_manager',
                'description' => 'Plans and executes off-site tours and excursions.',
                '_hierarchy_matrix_level' => 60,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Tour Guide',
                '_slug'       => 'tour_guide',
                'description' => 'Leads guests on tours, provides commentary.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Driver',
                '_slug'       => 'driver',
                'description' => 'Transports guests to/from destinations.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── CAR WASH & VALET ──────────────────────
            [
                'name'        => 'Car Wash Manager',
                '_slug'       => 'car_wash_manager',
                'description' => 'Runs car-wash and detailing services.',
                '_hierarchy_matrix_level' => 70,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Car Detailer',
                '_slug'       => 'car_detailer',
                'description' => 'Performs interior/exterior detailing.',
                '_hierarchy_matrix_level' => 50,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Car Wash Attendant',
                '_slug'       => 'car_wash_attendant',
                'description' => 'Washes vehicles, dries and vacuums.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Valet Attendant',
                '_slug'       => 'valet_attendant',
                'description' => 'Parks and retrieves guest vehicles.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── PARKING ───────────────────────────────
            [
                'name'        => 'Parking Manager',
                '_slug'       => 'parking_manager',
                'description' => 'Supervises parking lot operations.',
                '_hierarchy_matrix_level' => 60,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Parking Attendant',
                '_slug'       => 'parking_attendant',
                'description' => 'Directs cars, collects fees, assists guests.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── INVENTORY & PROCUREMENT ───────────────
            [
                'name'        => 'Inventory Manager',
                '_slug'       => 'inventory_manager',
                'description' => 'Tracks stock levels for food, beverage, supplies.',
                '_hierarchy_matrix_level' => 60,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Store Keeper',
                '_slug'       => 'store_keeper',
                'description' => 'Issues and receives goods in the storeroom.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── HR ───────────────────────────────────
            [
                'name'        => 'HR Manager',
                '_slug'       => 'hr_manager',
                'description' => 'Handles recruitment, payroll, employee relations.',
                '_hierarchy_matrix_level' => 70,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Recruiter',
                '_slug'       => 'recruiter',
                'description' => 'Sources and on-boards new staff.',
                '_hierarchy_matrix_level' => 50,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── SALES & MARKETING ────────────────────
            [
                'name'        => 'Sales & Marketing Manager',
                '_slug'       => 'sales_marketing_manager',
                'description' => 'Drives promotions, partnerships and revenue growth.',
                '_hierarchy_matrix_level' => 70,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Sales Person',
                '_slug'       => 'sales_person',
                'description' => 'Sells products and services.',
                '_hierarchy_matrix_level' => 50,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Social Media Influencer',
                '_slug'       => 'social_media_influencer',
                'description' => 'Promotes products and services.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── MAINTENANCE & FACILITIES ──────────────
            [
                'name'        => 'Maintenance Manager',
                '_slug'       => 'maintenance_manager',
                'description' => 'Oversees building repairs, plumbing, electrical.',
                '_hierarchy_matrix_level' => 60,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'Maintenance Technician',
                '_slug'       => 'maintenance_technician',
                'description' => 'Performs repairs and preventive maintenance.',
                '_hierarchy_matrix_level' => 50,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── CUSTOMER CARE & IT TECHNICIAN SUPPORT ──────────────────────
            [
                'name'        => 'Customer Care Support',
                '_slug'       => 'customer_care_support',
                'description' => 'Resolves customer care issues for staff.',
                '_hierarchy_matrix_level' => 50,
                '_status'     => Role::SUSPENDED
            ],
            [
                'name'        => 'IT Technician Support',
                '_slug'       => 'it_technician_support',
                'description' => 'Resolves IT technician issues for staff.',
                '_hierarchy_matrix_level' => 60,
                '_status'     => Role::SUSPENDED
            ],

            // ────────────────────── SECURITY & CCTV ───────────────────────
            [
                'name'        => 'Security Manager',
                '_slug'       => 'security_manager',
                'description' => 'Coordinates all security personnel and protocols.',
                '_hierarchy_matrix_level' => 70,
                '_status'     => Role::ACTIVE
            ],
            [
                'name'        => 'Security Guard',
                '_slug'       => 'security_guard',
                'description' => 'Monitors security.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::ACTIVE
            ],
            [
                'name'        => 'CCTV Operator',
                '_slug'       => 'cctv_operator',
                'description' => 'Monitors surveillance feeds and logs incidents.',
                '_hierarchy_matrix_level' => 40,
                '_status'     => Role::SUSPENDED
            ],
        ];

        // Insert in chunks for better performance with large datasets
        foreach (array_chunk($roles, 20) as $chunk) {
            DB::table('roles')->insert($chunk);
        }

        $this->command->info('Successfully seeded ' . count($roles) . ' roles!');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('_uuid')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Personal Info
            $table->string('_salutation')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('_gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->longText('biography')->nullable();
            $table->json('social_links')->nullable();
            $table->string('telephone')->nullable();

            // Address
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('_state')->nullable();
            $table->string('country', 60)->nullable(); // or 2 for ISO code

            // Preferences
            $table->string('_timezone')->default('Africa/Nairobi');
            $table->string('_locale', 10)->default('en');

            // Identification
            $table->string('tax_number')->unique()->nullable();
            $table->string('national_id_number')->unique()->nullable();
            $table->string('passport_number')->unique()->nullable();
            $table->string('drivers_license_number')->unique()->nullable();
            $table->string('vehicle_registration_number')->unique()->nullable();

            // Settings & Status
            $table->json('configuration')->default(json_encode([
                'notifications' => [
                    'email' => [
                        'marketing' => false,
                        'security' => true,
                        'updates' => true,
                        'invoices' => true
                    ],
                    "sms" => [
                        "security" => true,
                        "reminders" => false,
                        "marketing" => false
                    ],
                    "push" => [
                        "messages" => true,
                        "mentions" => true,
                        "tasks" => true,
                        "marketing" => false
                    ],
                    "in_app" => [
                        "all" => true,
                        "sound" => true,
                        "badge" => true
                    ],
                    "quiet_hours" => [
                        "enabled" => false,
                        "from" => "22:00",
                        "to" => "07:00",
                        "timezone" => "Africa/Nairobi"
                    ]
                ]
            ]));
            $table->tinyInteger('_status')->default(0); // 0 = pending, 1 = active, etc.
            $table->string('avatar')->nullable(); // optional

            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('_uuid');
            $table->index('_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

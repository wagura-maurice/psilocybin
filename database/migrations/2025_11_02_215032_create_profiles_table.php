<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Profile;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            // -----------------------------------------------------------------
            // Core
            // -----------------------------------------------------------------
            $table->id();
            $table->uuid('_uuid')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // -----------------------------------------------------------------
            // Personal Info (keep only what's useful)
            // -----------------------------------------------------------------
            $table->string('salutation')->nullable();           // Mr, Mrs, Dr, etc.
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();               // male, female, other, prefer-not-to-say
            $table->string('race')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('telephone', 20)->nullable()->unique(); // E.164: +2547...
            $table->longText('biography')->nullable();
            $table->json('social_links')->nullable()->default(json_encode([
                'facebook' => null,
                'twitter' => null,
                'instagram' => null,
                'linkedin' => null,
            ]));

            // -----------------------------------------------------------------
            // Address
            // -----------------------------------------------------------------
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country', 2)->nullable();           // ISO 3166-1 alpha-2 (KE, US, etc.)
            $table->string('zip_code')->nullable();
            $table->string('postal_code')->nullable();

            // -----------------------------------------------------------------
            // Preferences
            // -----------------------------------------------------------------
            $table->string('timezone')->default('Africa/Nairobi');
            $table->string('locale', 10)->default('en');

            // -----------------------------------------------------------------
            // Identification (KYC)
            // -----------------------------------------------------------------
            $table->string('tax_number')->nullable()->unique();
            $table->string('national_identification_number')->nullable()->unique();
            $table->string('passport_number')->nullable()->unique();
            $table->string('drivers_license_number')->nullable()->unique();
            $table->string('vehicle_registration_number')->nullable()->unique();

            // -----------------------------------------------------------------
            // Configuration & Status
            // -----------------------------------------------------------------
            $table->json('configuration')->default(json_encode([
                "notifications" => [
                    "email" => ["marketing" => false, "security" => true, "updates" => true, "invoices" => true],
                    "sms" => ["security" => true, "reminders" => false, "marketing" => false],
                    "push" => ["messages" => true, "mentions" => true, "tasks" => true, "marketing" => false],
                    "in_app" => ["all" => true, "sound" => true, "badge" => true],
                    "quiet_hours" => ["enabled" => false, "from" => "22:00", "to" => "07:00", "timezone" => "Africa/Nairobi"]
                ],
            ]));

            // Status: 0 = pending, 1 = active, 2 = suspended, 3 = archived
            $table->tinyInteger('_status')->default(Profile::STATUS_PENDING);

            // -----------------------------------------------------------------
            // Auditing
            // -----------------------------------------------------------------
            $table->softDeletes();
            $table->timestamps();

            // -----------------------------------------------------------------
            // Indexes
            // -----------------------------------------------------------------
            $table->index('_uuid');
            $table->index('user_id');
            $table->index('telephone');
            $table->index('tax_number');
            $table->index('national_identification_number');
            $table->index('passport_number');
            $table->index('drivers_license_number');
            $table->index('vehicle_registration_number');
            $table->index('configuration');
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

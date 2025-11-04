<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Profile::class;
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $gender = $this->getRandomGender();
        $firstName = $this->faker->firstName($gender);
        $middleName = $this->faker->boolean(30) ? $this->faker->firstName($gender) : null;
        
        return [
            '_uuid' => (string) Str::uuid(),
            'user_id' => User::factory(),
            
            // Personal Info
            'salutation' => $this->getRandomSalutation(),
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $this->faker->lastName(),
            'gender' => $gender,
            'marital_status' => $this->getRandomMaritalStatus(),
            'date_of_birth' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'biography' => $this->faker->text(500),
            'social_links' => [
                'facebook' => 'https://facebook.com/'.$this->faker->userName,
                'twitter' => 'https://twitter.com/'.$this->faker->userName,
                'instagram' => 'https://instagram.com/'.$this->faker->userName,
                'linkedin' => 'https://linkedin.com/in/'.$this->faker->userName,
            ],
            'telephone' => $this->faker->unique()->phoneNumber(),
            
            // Address
            'address_line_1' => $this->faker->streetAddress(),
            'address_line_2' => $this->faker->boolean(70) ? $this->faker->secondaryAddress() : null,
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'country' => $this->faker->countryCode(),
            
            // Preferences
            'timezone' => 'Africa/Nairobi',
            'locale' => 'en',
            
            // Identification
            'tax_number' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'national_identification_number' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'passport_number' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'drivers_license_number' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'vehicle_registration_number' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            
            // Settings & Status
            'configuration' => [
                'notifications' => [
                    'email' => [
                        'marketing' => false,
                        'security' => true,
                        'updates' => true,
                        'invoices' => true
                    ],
                    'sms' => [
                        'security' => true,
                        'reminders' => false,
                        'marketing' => false
                    ],
                    'push' => [
                        'messages' => true,
                        'mentions' => true,
                        'tasks' => true,
                        'marketing' => false
                    ],
                    'in_app' => [
                        'all' => true,
                        'sound' => true,
                        'badge' => true
                    ],
                    'quiet_hours' => [
                        'enabled' => false,
                        'from' => '22:00',
                        'to' => '07:00',
                        'timezone' => 'Africa/Nairobi'
                    ]
                ]
            ],
            '_status' => $this->getRandomStatus(),
        ];
    }

    /**
     * Indicate that the profile is active.
     */
    public function active(): static
    {
        return $this->state([
            '_status' => Profile::ACTIVE,
        ]);
    }

    /**
     * Indicate that the profile is pending.
     */
    public function pending(): static
    {
        return $this->state([
            '_status' => Profile::PENDING,
        ]);
    }

    /**
     * Indicate that the profile is suspended.
     */
    public function suspended(): static
    {
        return $this->state([
            '_status' => Profile::SUSPENDED,
        ]);
    }

    /**
     * Indicate that the profile is for a specific user.
     */
    public function forUser(User $user): static
    {
        return $this->state([
            'user_id' => $user->id,
        ]);
    }

    /**
     * Get a random salutation.
     */
    protected function getRandomSalutation(): int
    {
        return $this->faker->randomElement([
            Profile::SALUTATION_MR, 
            Profile::SALUTATION_MRS, 
            Profile::SALUTATION_MS, 
            Profile::SALUTATION_MISS, 
            Profile::SALUTATION_DR, 
            Profile::SALUTATION_PROF, 
            Profile::SALUTATION_SIR, 
            Profile::SALUTATION_MADAM, 
            Profile::SALUTATION_MX
        ]);
    }

    /**
     * Get a random gender.
     */
    protected function getRandomGender(): int
    {
        return $this->faker->randomElement([
            Profile::GENDER_MALE, 
            Profile::GENDER_FEMALE
        ]);
    }

    /**
     * Get a random marital status.
     */
    protected function getRandomMaritalStatus(): int
    {
        return $this->faker->randomElement([
            Profile::MARITAL_STATUS_MARRIED,
            Profile::MARITAL_STATUS_SINGLE,
            Profile::MARITAL_STATUS_DIVORCED
        ]);
    }

    /**
     * Get a random status.
     */
    /**
     * Get a random status.
     */
    protected function getRandomStatus(): int
    {
        return $this->faker->randomElement([
            Profile::STATUS_PENDING, 
            Profile::STATUS_ACTIVE, 
            Profile::STATUS_SUSPENDED
        ]);
    }
}

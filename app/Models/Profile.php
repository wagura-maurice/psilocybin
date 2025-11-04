<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        '_salutation',
        'first_name',
        'middle_name',
        'last_name',
        '_gender',
        'date_of_birth',
        'biography',
        'social_links',
        'telephone',
        'address_line_1',
        'address_line_2',
        'city',
        '_state',
        'country',
        '_timezone',
        '_locale',
        'tax_number',
        'national_id_number',
        'passport_number',
        'drivers_license_number',
        'vehicle_registration_number',
        'configuration',
        '_status',
        'avatar'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'social_links' => 'array',
        'configuration' => 'array',
        '_status' => 'integer',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'configuration' => '{
            "notifications": {
                "email": {
                    "marketing": false,
                    "security": true,
                    "updates": true,
                    "invoices": true
                },
                "sms": {
                    "security": true,
                    "reminders": false,
                    "marketing": false
                },
                "push": {
                    "messages": true,
                    "mentions": true,
                    "tasks": true,
                    "marketing": false
                },
                "in_app": {
                    "all": true,
                    "sound": true,
                    "badge": true
                },
                "quiet_hours": {
                    "enabled": false,
                    "from": "22:00",
                    "to": "07:00",
                    "timezone": "Africa/Nairobi"
                }
            }
        }',
        '_timezone' => 'Africa/Nairobi',
        '_locale' => 'en',
        '_status' => 0,
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute(): string
    {
        return trim(implode(' ', [
            $this->first_name,
            $this->middle_name,
            $this->last_name
        ]));
    }

    /**
     * Get the user's address as a single string.
     */
    public function getFullAddressAttribute(): ?string
    {
        $parts = [
            $this->address_line_1,
            $this->address_line_2,
            $this->city,
            $this->_state,
            $this->country
        ];

        $filtered = array_filter($parts);
        return $filtered ? implode(', ', $filtered) : null;
    }
}

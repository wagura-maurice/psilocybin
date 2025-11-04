<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    // =====================================================================
    // Constants
    // =====================================================================
    public const STATUS_PENDING   = 0;
    public const STATUS_ACTIVE   = 1;
    public const STATUS_SUSPENDED = 2;

    public const SALUTATION_MR = 0;
    public const SALUTATION_MRS = 1;
    public const SALUTATION_MS = 2;
    public const SALUTATION_MISS = 3;
    public const SALUTATION_DR = 4;
    public const SALUTATION_PROF = 5;
    public const SALUTATION_SIR = 6;
    public const SALUTATION_MADAM = 7;
    public const SALUTATION_MX = 8;

    public const GENDER_FEMALE = 0;
    public const GENDER_MALE = 1;
    public const GENDER_OTHER = 2;
    public const GENDER_PREFER_NOT_TO_SAY = 3;

    public const MARITAL_STATUS_MARRIED   = 0;
    public const MARITAL_STATUS_SINGLE   = 1;
    public const MARITAL_STATUS_DIVORCED = 2;

    // =====================================================================
    // Table & Fillable
    // =====================================================================
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'salutation',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'marital_status',
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
        '_status'
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Calculation extends Model
{
    protected $fillable = [
        'user_id',
        'business_type',
        'industry',
        'target_location',
        'monthly_revenue',
        'growth_stage',
        'total_cost',
        'roi_range',
    ];

    protected function casts(): array
    {
        return [
            'monthly_revenue' => 'decimal:2',
            'total_cost'      => 'decimal:2',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * The user who created this calculation (null for guest calculations).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The individual digital-marketing services included in this calculation.
     */
    public function services(): HasMany
    {
        return $this->hasMany(CalculationService::class);
    }

    /**
     * Proposals generated from this calculation.
     */
    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }
}

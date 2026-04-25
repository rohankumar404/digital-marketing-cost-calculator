<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalculationService extends Model
{
    protected $fillable = [
        'calculation_id',
        'service_name',
        'inputs',
        'estimated_cost',
    ];

    protected function casts(): array
    {
        return [
            // Automatically encode/decode the flexible inputs JSON column
            'inputs'         => 'array',
            'estimated_cost' => 'decimal:2',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * The parent calculation this service belongs to.
     */
    public function calculation(): BelongsTo
    {
        return $this->belongsTo(Calculation::class);
    }
}

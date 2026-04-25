<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsageLimit extends Model
{
    protected $fillable = [
        'user_id',
        'usage_count',
        'last_used_at',
    ];

    protected function casts(): array
    {
        return [
            'last_used_at' => 'datetime',
            'usage_count'  => 'integer',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * The user this usage record belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // -------------------------------------------------------------------------
    // Convenience helpers
    // -------------------------------------------------------------------------

    /**
     * Increment the usage counter and update the last-used timestamp.
     * Creates the record if it doesn't exist yet (upsert-style).
     *
     * Usage:
     *   UsageLimit::track($user->id);
     *
     * @param  int  $userId
     * @return static
     */
    public static function track(int $userId): static
    {
        $record = static::firstOrCreate(
            ['user_id' => $userId],
            ['usage_count' => 0]
        );

        $record->increment('usage_count');
        $record->update(['last_used_at' => now()]);

        return $record;
    }
}

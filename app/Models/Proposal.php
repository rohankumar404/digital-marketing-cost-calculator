<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Proposal extends Model
{
    protected $fillable = [
        'user_id',
        'calculation_id',
        'file_path',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * The user who owns this proposal.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The calculation this proposal was generated from.
     */
    public function calculation(): BelongsTo
    {
        return $this->belongsTo(Calculation::class);
    }

    // -------------------------------------------------------------------------
    // Convenience helpers
    // -------------------------------------------------------------------------

    /**
     * Return the public download URL for this proposal file.
     *
     * Usage:
     *   $url = $proposal->downloadUrl();
     *
     * @return string
     */
    public function downloadUrl(): string
    {
        return Storage::url($this->file_path);
    }
}

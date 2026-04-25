<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'message',
        'calculation_id',
        'type'
    ];

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }
}

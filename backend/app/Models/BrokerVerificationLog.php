<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BrokerVerificationLog extends Model
{
    protected $fillable = [
        'broker_profile_id',
        'actor_id',
        'action',
        'notes',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(BrokerProfile::class, 'broker_profile_id');
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
}

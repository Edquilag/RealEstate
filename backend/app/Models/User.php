<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
])]

#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'approved_at',
        'rejected_at',
        'approval_notes',
        'prc_license_number',
        'prc_license_expiry',
        'tin',
        'company_name',
        'office_address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
            'prc_license_expiry' => 'date',
            'password' => 'hashed',
            'role' => 'string',
            'status' => 'string',
        ];
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'broker_id');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'client_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isBroker(): bool
    {
        return $this->role === 'broker';
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    public function scopeByRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function brokerProfile()
    {
        return $this->hasOne(BrokerProfile::class);
    }

    public function verificationLogs()
    {
        return $this->hasMany(BrokerVerificationLog::class, 'actor_id');
    }

    public function conversationsAsClient()
    {
        return $this->hasMany(Conversation::class, 'client_id');
    }

    public function conversationsAsBroker()
    {
        return $this->hasMany(Conversation::class, 'broker_id');
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}
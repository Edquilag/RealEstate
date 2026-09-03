<?php

namespace App\Models;

use Database\Factories\PropertyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'broker_id',
        'title',
        'description',
        'property_type',
        'listing_type',
        'location',
        'price',
        'floor_area',
        'status',
    ];

    protected static function newFactory()
    {
        return PropertyFactory::new();
    }

    protected $casts = [
        'price' => 'decimal:2',
        'floor_area' => 'decimal:2',
        'status' => 'string',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeForSale($query)
    {
        return $query->where('listing_type', 'sale');
    }

    public function scopeForLease($query)
    {
        return $query->where('listing_type', 'lease');
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'broker_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }
}
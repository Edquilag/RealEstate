<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'property_type' => $this->property_type,
            'listing_type' => $this->listing_type,
            'location' => $this->location,
            'price' => (float) $this->price,
            'floor_area' => (float) $this->floor_area,
            'status' => $this->status,
            'broker' => [
                'id' => $this->broker?->id,
                'name' => $this->broker?->name,
            ],
            'images' => $this->images->map(fn ($image) => [
                'id' => $image->id,
                'url' => asset('storage/'.$image->image_path),
            ])->values()->all(),
        ];
    }
}

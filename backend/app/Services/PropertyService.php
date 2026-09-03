<?php

namespace App\Services;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class PropertyService
{
    public function listForPublic(): Collection
    {
        return Property::with('images')->where('status', 'available')->latest()->get();
    }

    public function findForPublic(int|string $id): Property
    {
        return Property::with(['images', 'broker'])->findOrFail($id);
    }

    public function listForBroker(int $brokerId): Collection
    {
        return Property::where('broker_id', $brokerId)->with('images')->latest()->get();
    }

    public function createForBroker(int $brokerId, array $data, array $images = []): Property
    {
        $property = Property::create([
            'broker_id' => $brokerId,
            'title' => $data['title'],
            'description' => $data['description'],
            'property_type' => $data['property_type'],
            'listing_type' => $data['listing_type'],
            'location' => $data['location'],
            'price' => $data['price'],
            'floor_area' => $data['floor_area'],
            'status' => 'available',
        ]);

        $this->saveImages($property, $images);

        return $property;
    }

    public function updateForBroker(Property $property, array $data, array $images = []): Property
    {
        $property->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'property_type' => $data['property_type'],
            'listing_type' => $data['listing_type'],
            'location' => $data['location'],
            'price' => $data['price'],
            'floor_area' => $data['floor_area'],
        ]);

        $this->saveImages($property, $images);

        return $property->fresh();
    }

    public function deleteForBroker(Property $property): void
    {
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $property->delete();
    }

    protected function saveImages(Property $property, array $images): void
    {
        foreach ($images as $image) {
            if (! $image instanceof UploadedFile || ! $image->isValid()) {
                continue;
            }

            $path = $image->store('properties', 'public');

            PropertyImage::create([
                'property_id' => $property->getKey(),
                'image_path' => $path,
            ]);
        }
    }
}

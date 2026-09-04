<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Property::query()
            ->with(['images', 'broker'])
            ->where('status', 'available');

        $keyword = trim((string) $request->query('keyword', ''));
        $propertyType = trim((string) $request->query('property_type', ''));
        $listingType = trim((string) $request->query('listing_type', ''));
        $location = trim((string) $request->query('location', ''));
        $priceMin = $request->query('price_min');
        $priceMax = $request->query('price_max');

        if ($keyword !== '') {
            $query->where(function ($propertyQuery) use ($keyword) {
                $propertyQuery->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('location', 'like', "%{$keyword}%");
            });
        }

        if ($propertyType !== '') {
            $query->where('property_type', $propertyType);
        }

        if ($listingType !== '') {
            $query->where('listing_type', $listingType);
        }

        if ($location !== '') {
            $query->where('location', 'like', "%{$location}%");
        }

        if ($priceMin !== null && is_numeric($priceMin)) {
            $query->where('price', '>=', (float) $priceMin);
        }

        if ($priceMax !== null && is_numeric($priceMax)) {
            $query->where('price', '<=', (float) $priceMax);
        }

        $properties = $query->latest()->paginate(12);

        return response()->json([
            'data' => PropertyResource::collection($properties),
            'meta' => [
                'current_page' => $properties->currentPage(),
                'per_page' => $properties->perPage(),
                'total' => $properties->total(),
                'last_page' => $properties->lastPage(),
            ],
        ]);
    }

    public function show(Property $property): JsonResponse
    {
        $property->load(['images', 'broker']);

        return response()->json([
            'data' => new PropertyResource($property),
        ]);
    }
}

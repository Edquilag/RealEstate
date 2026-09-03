<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\JsonResponse;

class PropertyController extends Controller
{
    public function index(): JsonResponse
    {
        $properties = Property::with(['images', 'broker'])
            ->where('status', 'available')
            ->latest()
            ->paginate(12);

        return response()->json([
            'data' => PropertyResource::collection($properties),
            'meta' => [
                'current_page' => $properties->currentPage(),
                'per_page' => $properties->perPage(),
                'total' => $properties->total(),
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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InquiryStoreRequest;
use App\Http\Resources\InquiryResource;
use App\Models\Inquiry;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function index(): JsonResponse
    {
        $inquiries = Inquiry::where('client_id', Auth::id())
            ->with('property')
            ->latest()
            ->get();

        return response()->json([
            'data' => InquiryResource::collection($inquiries),
        ]);
    }

    public function store(InquiryStoreRequest $request, Property $property): JsonResponse
    {
        $inquiry = Inquiry::create([
            'property_id' => $property->id,
            'client_id' => Auth::id(),
            'message' => $request->string('message'),
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Your inquiry has been sent.',
            'data' => new InquiryResource($inquiry->load('property')),
        ], 201);
    }

    public function brokerIndex(): JsonResponse
    {
        $inquiries = Inquiry::whereHas('property', fn ($query) => $query->where('broker_id', Auth::id()))
            ->with(['property', 'client'])
            ->latest()
            ->get();

        return response()->json([
            'data' => InquiryResource::collection($inquiries),
        ]);
    }

    public function updateStatus(Inquiry $inquiry): JsonResponse
    {
        abort_unless(Auth::user()?->isBroker() && $inquiry->property->broker_id === Auth::id(), 403);

        $inquiry->update([
            'status' => request('status', 'pending'),
        ]);

        return response()->json([
            'message' => 'Inquiry status updated.',
            'data' => new InquiryResource($inquiry->fresh(['property'])),
        ]);
    }
}

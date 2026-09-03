<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Inquiry;
use App\Models\Property;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function create(Property $property)
    {
        return view('inquiries.create', compact('property'));
    }

    public function store(Request $request, Property $property)
    {
        $request->validate([
            'message' => 'required|string|min:3|max:2000',
        ]);

        $inquiry = Inquiry::create([
            'property_id' => $property->id,
            'client_id' => auth()->id(),
            'broker_id' => $property->broker_id,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        Conversation::firstOrCreate(
            [
                'property_id' => $property->id,
                'client_id' => auth()->id(),
                'broker_id' => $property->broker_id,
            ],
            [
                'inquiry_id' => $inquiry->id,
                'status' => 'open',
                'last_message_at' => now(),
            ]
        );

        return redirect()
            ->route('properties.show', ['id' => $property->id])
            ->with('success', 'Your inquiry has been sent.');
    }
}
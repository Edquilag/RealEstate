<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::whereHas('property', function ($query) {

            $query->where('broker_id', auth()->id());

        })
        ->with(['property', 'client'])
        ->latest()
        ->get();


        return view(
            'broker.inquiries.index',
            compact('inquiries')
        );
    }

    public function update(Request $request, $id)
    {
        $inquiry = Inquiry::whereHas('property', function ($query) {
            $query->where('broker_id', auth()->id());
        })
        ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,contacted,closed',
        ]);

        $inquiry->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('broker.inquiries.index')
            ->with('success', 'Inquiry status updated.');
    }
}
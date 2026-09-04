<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserApprovalController extends Controller
{
    public function index(): View
    {
        $pendingUsers = User::whereIn('role', ['broker', 'client'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.approvals.index', compact('pendingUsers'));
    }

    public function approve(User $user): RedirectResponse
    {
        $user->update([
            'status' => 'approved',
            'approved_at' => now(),
            'rejected_at' => null,
            'approval_notes' => 'Approved by admin.',
        ]);

        if ($user->role === 'broker' && $user->brokerProfile) {
            $user->brokerProfile->update([
                'status' => 'approved',
                'approved_at' => now(),
                'rejected_at' => null,
                'verification_notes' => 'Approved by admin.',
            ]);

            $user->brokerProfile->verificationLogs()->create([
                'actor_id' => auth()->id(),
                'action' => 'approved',
                'notes' => 'Approved by admin.',
            ]);
        }

        return redirect()->route('admin.approvals.index')->with('success', 'User approved.');
    }

    public function reject(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $user->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'approval_notes' => $request->input('notes', 'Rejected by admin.'),
        ]);

        if ($user->role === 'broker' && $user->brokerProfile) {
            $user->brokerProfile->update([
                'status' => 'rejected',
                'rejected_at' => now(),
                'verification_notes' => $request->input('notes', 'Rejected by admin.'),
            ]);

            $user->brokerProfile->verificationLogs()->create([
                'actor_id' => auth()->id(),
                'action' => 'rejected',
                'notes' => $request->input('notes', 'Rejected by admin.'),
            ]);
        }

        return redirect()->route('admin.approvals.index')->with('success', 'User rejected.');
    }
}

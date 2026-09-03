<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Inquiry;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ConversationController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->isBroker()) {
            $conversations = Conversation::where('broker_id', $user->id)
                ->with(['property', 'client', 'messages'])
                ->latest('last_message_at')
                ->get();
        } else {
            $conversations = Conversation::where('client_id', $user->id)
                ->with(['property', 'broker', 'messages'])
                ->latest('last_message_at')
                ->get();
        }

        return view('conversations.index', compact('conversations'));
    }

    public function show(Conversation $conversation): View
    {
        abort_unless(
            Auth::id() === $conversation->client_id || Auth::id() === $conversation->broker_id,
            403
        );

        $conversation->load(['property', 'client', 'broker', 'messages.sender', 'messages.receiver']);

        return view('conversations.show', compact('conversation'));
    }

    public function storeMessage(Request $request, Conversation $conversation): RedirectResponse
    {
        abort_unless(
            Auth::id() === $conversation->client_id || Auth::id() === $conversation->broker_id,
            403
        );

        $validated = $request->validate([
            'body' => ['required', 'string', 'min:1', 'max:2000'],
        ]);

        $senderId = Auth::id();
        $receiverId = $senderId === $conversation->client_id ? $conversation->broker_id : $conversation->client_id;

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'body' => $validated['body'],
            'type' => 'text',
        ]);

        $conversation->update([
            'last_message_at' => $message->created_at,
        ]);

        if ($conversation->inquiry) {
            $conversation->inquiry->update([
                'status' => 'contacted',
            ]);
        }

        return redirect()->route('conversations.show', $conversation);
    }
}

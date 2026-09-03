<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Conversation for {{ $conversation->property->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                <div class="space-y-4 mb-6">
                    @forelse($conversation->messages as $message)
                        <div class="{{ $message->sender_id === auth()->id() ? 'ml-auto max-w-xl' : 'mr-auto max-w-xl' }}">
                            <div class="rounded-lg px-4 py-3 {{ $message->sender_id === auth()->id() ? 'bg-black text-white' : 'bg-gray-100 text-gray-900' }}">
                                <div class="text-xs uppercase tracking-wide opacity-75 mb-1">
                                    {{ $message->sender->name }}
                                </div>
                                <div>{{ $message->body }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-600">No messages yet. Start the conversation.</div>
                    @endforelse
                </div>

                <form method="POST" action="{{ route('conversations.messages.store', $conversation) }}" class="space-y-3">
                    @csrf

                    <label for="body" class="block text-sm font-medium text-gray-700">Reply</label>
                    <textarea id="body" name="body" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black" required></textarea>

                    <button type="submit" class="border border-black bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-0">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

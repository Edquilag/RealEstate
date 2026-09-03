<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @forelse($conversations as $conversation)
                <a href="{{ route('conversations.show', $conversation) }}" class="block bg-white border border-black rounded-lg p-5 shadow-sm hover:bg-gray-50 transition focus:outline-none focus:ring-0">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-lg font-bold text-gray-900">
                                {{ auth()->user()->role === 'broker' ? $conversation->client->name : $conversation->broker->name }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $conversation->property->title }}
                            </p>
                        </div>
                        <span class="text-xs uppercase tracking-wide text-gray-600">
                            {{ $conversation->status }}
                        </span>
                    </div>

                    @if($conversation->messages->last())
                        <p class="mt-3 text-gray-700 line-clamp-2">
                            {{ Str::limit($conversation->messages->last()->body, 120) }}
                        </p>
                    @endif
                </a>
            @empty
                <div class="bg-white border border-gray-200 rounded-lg p-6 text-gray-700">
                    No conversations yet.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

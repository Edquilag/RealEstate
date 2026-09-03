<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Approvals
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @forelse($pendingUsers as $user)
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                            <p class="text-gray-600">{{ $user->email }}</p>
                            <p class="text-gray-600">Role: <span class="font-semibold uppercase">{{ $user->role }}</span></p>

                            @if($user->role === 'broker')
                                <div class="mt-3 text-sm text-gray-700 space-y-1">
                                    <p><strong>Company:</strong> {{ $user->company_name ?? 'N/A' }}</p>
                                    <p><strong>Office Address:</strong> {{ $user->office_address ?? 'N/A' }}</p>
                                    <p><strong>PRC License:</strong> {{ $user->prc_license_number ?? 'N/A' }}</p>
                                    <p><strong>PRC Expiry:</strong> {{ $user->prc_license_expiry?->format('Y-m-d') ?? 'N/A' }}</p>
                                    <p><strong>TIN:</strong> {{ $user->tin ?? 'N/A' }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="flex gap-3">
                            <form method="POST" action="{{ route('admin.approvals.approve', $user) }}">
                                @csrf
                                <button type="submit" class="border border-black bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-0">
                                    Approve
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.approvals.reject', $user) }}">
                                @csrf
                                <input type="hidden" name="notes" value="Rejected by admin review.">
                                <button type="submit" class="border border-black bg-white text-black px-4 py-2 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-0">
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 text-gray-700">
                    No users are pending approval.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

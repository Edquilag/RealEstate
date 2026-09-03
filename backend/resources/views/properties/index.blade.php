<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Commercial Properties
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if($properties->count() > 0)
                @foreach($properties as $property)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-3">
                                {{ $property->title }}
                            </h2>

                            <p class="text-gray-700">
                                <strong>Type:</strong>
                                {{ $property->property_type }}
                            </p>

                            <p class="text-gray-700">
                                <strong>Location:</strong>
                                {{ $property->location }}
                            </p>

                            <p class="text-gray-700">
                                <strong>Price:</strong>
                                ₱{{ number_format($property->price,2) }}
                            </p>

                            @if($property->images->first())
                                <img
                                    src="{{ asset('storage/'.$property->images->first()->image_path) }}"
                                    width="300"
                                    class="my-4 rounded-lg"
                                >
                            @endif

                            <div class="mt-4">
                                <a href="{{ route('properties.show', ['id' => $property->id]) }}"
                                   class="inline-flex items-center px-4 py-2 border border-black bg-black rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 focus:outline-none focus:ring-0 transition ease-in-out duration-150">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6 text-gray-700">
                        No commercial properties available.
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
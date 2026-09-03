<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Property
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="p-6">
                    <form method="POST"
                          action="{{ route('broker.properties.update', $property->id) }}"
                          enctype="multipart/form-data"
                          class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input id="title"
                                   name="title"
                                   value="{{ old('title', $property->title) }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:border-black focus:ring-0">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description"
                                      name="description"
                                      rows="5"
                                      class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:border-black focus:ring-0">{{ old('description', $property->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="property_type" class="block text-sm font-medium text-gray-700 mb-1">Property Type</label>
                                <input id="property_type"
                                       name="property_type"
                                       value="{{ old('property_type', $property->property_type) }}"
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:border-black focus:ring-0">
                                @error('property_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="listing_type" class="block text-sm font-medium text-gray-700 mb-1">Listing Type</label>
                                <input id="listing_type"
                                       name="listing_type"
                                       value="{{ old('listing_type', $property->listing_type) }}"
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:border-black focus:ring-0">
                                @error('listing_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input id="location"
                                   name="location"
                                   value="{{ old('location', $property->location) }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:border-black focus:ring-0">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                <input id="price"
                                       type="number"
                                       step="0.01"
                                       name="price"
                                       value="{{ old('price', $property->price) }}"
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:border-black focus:ring-0">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="floor_area" class="block text-sm font-medium text-gray-700 mb-1">Floor Area</label>
                                <input id="floor_area"
                                       type="number"
                                       step="0.01"
                                       name="floor_area"
                                       value="{{ old('floor_area', $property->floor_area) }}"
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:border-black focus:ring-0">
                                @error('floor_area')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-900 mb-3">Current Images</h3>

                            @if($property->images->count())
                                <div class="flex flex-wrap gap-3 mb-5">
                                    @foreach($property->images as $image)
                                        <img src="{{ asset('storage/'.$image->image_path) }}"
                                             class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500 mb-5">No images uploaded yet.</p>
                            @endif
                        </div>

                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Add More Images</label>
                            <input id="images"
                                   type="file"
                                   name="images[]"
                                   multiple
                                   class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-black file:text-white file:font-medium hover:file:bg-gray-800">
                            @error('images')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class="inline-flex items-center px-5 py-3 border border-black bg-black text-white font-medium rounded-md hover:bg-gray-900 focus:outline-none focus:ring-0">
                                Update Property
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

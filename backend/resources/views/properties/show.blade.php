<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $property->title }}
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg border border-gray-200">

                <div class="p-6">


                    <h3 class="text-lg font-bold mb-4">
                        Property Images
                    </h3>


                    @if($property->images->count())

                        <div class="flex flex-wrap gap-4 mb-6">

                            @foreach($property->images as $image)

                                <img
                                    src="{{ asset('storage/'.$image->image_path) }}"
                                    width="300"
                                    class="rounded-lg border"
                                >

                            @endforeach

                        </div>

                    @else

                        <p>
                            No images available.
                        </p>

                    @endif



                    <div class="space-y-3">

                        <p>
                            <strong>Property Type:</strong>
                            {{ $property->property_type }}
                        </p>


                        <p>
                            <strong>Listing Type:</strong>
                            {{ $property->listing_type }}
                        </p>


                        <p>
                            <strong>Location:</strong>
                            {{ $property->location }}
                        </p>


                        <p>
                            <strong>Floor Area:</strong>
                            {{ $property->floor_area }} sqm
                        </p>


                        <p>
                            <strong>Price:</strong>
                            ₱{{ number_format($property->price,2) }}
                        </p>

                    </div>



                    <h3 class="mt-8 text-lg font-bold">
                        Description
                    </h3>


                    <p class="mt-2">
                        {{ $property->description }}
                    </p>



                    <h3 class="mt-8 text-lg font-bold">
                        Broker Information
                    </h3>


                    <p>
                        <strong>Name:</strong>
                        {{ $property->broker->name }}
                    </p>



                    @auth

                        @if(auth()->user()->role === 'client')

                        <div class="mt-6">

                            <a href="{{ route('inquiries.create', ['property' => $property->id]) }}"
   class="inline-flex items-center px-4 py-2 border border-black bg-black text-white rounded-md hover:bg-gray-800 focus:outline-none focus:ring-0">

    Send Inquiry

</a>

                        </div>

                        @endif

                    @endauth


                </div>

            </div>


        </div>

    </div>

</x-app-layout>
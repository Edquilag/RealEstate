<x-app-layout>


<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800">

My Properties

</h2>

</x-slot>




<div class="py-12">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



<a href="{{ route('broker.properties.create') }}"
class="inline-flex px-5 py-3 border border-black bg-black text-white rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-0">

+ Add Commercial Property

</a>




@if(session('success'))

<div class="mt-5 bg-green-100 p-4 rounded">

{{ session('success') }}

</div>

@endif





<div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">



@forelse($properties as $property)



<div class="bg-white rounded-xl shadow border overflow-hidden">



@if($property->images->first())


<img
src="{{ asset('storage/'.$property->images->first()->image_path) }}"
class="w-full h-48 object-cover">


@endif




<div class="p-5">


<h3 class="text-xl font-bold">

{{ $property->title }}

</h3>




<p class="mt-2 text-gray-600">

<strong>Type:</strong>

{{ $property->property_type }}

</p>



<p class="text-gray-600">

<strong>Location:</strong>

{{ $property->location }}

</p>



<p class="text-gray-600">

<strong>Price:</strong>

₱{{ number_format($property->price,2) }}

</p>





<div class="mt-5 flex flex-wrap gap-2">



<a href="{{ route('broker.properties.show',$property->id) }}"
class="px-3 py-2 border border-black bg-white text-black rounded-md hover:bg-gray-100 focus:outline-none focus:ring-0">

View Details

</a>




<a href="{{ route('broker.properties.edit',$property->id) }}"
class="px-3 py-2 border border-black bg-black text-white rounded-md hover:bg-gray-800 focus:outline-none focus:ring-0">

Edit

</a>




<form method="POST"
action="{{ route('broker.properties.destroy',$property->id) }}">

@csrf

@method('DELETE')


<button
class="px-3 py-2 border border-black bg-white text-black rounded-md hover:bg-gray-100 focus:outline-none focus:ring-0">

Delete

</button>


</form>



</div>



</div>


</div>



@empty


<div class="bg-white p-6 rounded shadow">

No properties listed yet.

</div>


@endforelse



</div>



</div>


</div>


</x-app-layout>
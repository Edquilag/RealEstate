<x-app-layout>


<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800">

Add Commercial Property

</h2>

</x-slot>



<div class="py-12">


<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">



@if($errors->any())

<div class="bg-red-100 p-4 mb-5 rounded">

@foreach($errors->all() as $error)

<p>{{ $error }}</p>

@endforeach

</div>

@endif




<form method="POST"
action="{{ route('broker.properties.store') }}"
enctype="multipart/form-data">


@csrf



<input class="border w-full p-3 mb-4"
name="title"
placeholder="Property Title">



<textarea class="border w-full p-3 mb-4"
name="description"
placeholder="Description"></textarea>




<input class="border w-full p-3 mb-4"
name="property_type"
placeholder="Property Type">



<input class="border w-full p-3 mb-4"
name="listing_type"
placeholder="For Sale / For Lease">



<input class="border w-full p-3 mb-4"
name="location"
placeholder="Location">



<input class="border w-full p-3 mb-4"
type="number"
name="price"
placeholder="Price">



<input class="border w-full p-3 mb-4"
type="number"
name="floor_area"
placeholder="Floor Area">



<input type="file"
name="images[]"
multiple
class="mb-5">



<button
class="px-5 py-3 border border-black bg-black text-white rounded-md hover:bg-gray-800 focus:outline-none focus:ring-0">

Save Property

</button>


</form>


</div>

</div>


</x-app-layout>
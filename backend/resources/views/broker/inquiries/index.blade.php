<x-app-layout>


<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800">
    My Inquiries
</h2>

</x-slot>



<div class="py-12">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


@if(session('success'))

<div class="mb-5 bg-green-100 border border-green-300 text-green-700 p-4 rounded">

{{ session('success') }}

</div>

@endif




@forelse($inquiries as $inquiry)


<div class="bg-white shadow rounded-lg p-6 mb-6">


<h3 class="text-xl font-bold text-gray-900">

{{ $inquiry->property->title }}

</h3>



<div class="mt-3 space-y-2">


<p>
<strong>Client:</strong>
{{ $inquiry->client->name }}
</p>



<p>
<strong>Email:</strong>
{{ $inquiry->client->email }}
</p>



<p>
<strong>Message:</strong>
{{ $inquiry->message }}
</p>



<p>
<strong>Status:</strong>

<span class="font-semibold">

{{ ucfirst($inquiry->status) }}

</span>

</p>


</div>





<form method="POST"
action="{{ route('broker.inquiries.update',$inquiry->id) }}"
class="mt-5 flex gap-3">


@csrf

@method('PATCH')



<select name="status"
class="border rounded px-3 py-2">


<option value="pending"
{{ $inquiry->status == 'pending' ? 'selected':'' }}>

Pending

</option>


<option value="contacted"
{{ $inquiry->status == 'contacted' ? 'selected':'' }}>

Contacted

</option>


<option value="closed"
{{ $inquiry->status == 'closed' ? 'selected':'' }}>

Closed

</option>


</select>



<button
class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800">

Update

</button>


</form>



</div>



@empty


<div class="bg-white p-6 rounded shadow">

No inquiries yet.

</div>


@endforelse



</div>


</div>


</x-app-layout>
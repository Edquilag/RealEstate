<h1>
    My Inquiries
</h1>


@if(session('success'))

<p>
    {{ session('success') }}
</p>

@endif



@forelse($inquiries as $inquiry)


<div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">


    <h3>
        {{ $inquiry->property->title }}
    </h3>


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
        {{ ucfirst($inquiry->status) }}
    </p>



    <form method="POST"
          action="{{ route('broker.inquiries.update', $inquiry->id) }}">

        @csrf
        @method('PATCH')


        <label>
            Change Status:
        </label>


        <select name="status">

            <option value="pending"
                {{ $inquiry->status == 'pending' ? 'selected' : '' }}>
                Pending
            </option>


            <option value="contacted"
                {{ $inquiry->status == 'contacted' ? 'selected' : '' }}>
                Contacted
            </option>


            <option value="closed"
                {{ $inquiry->status == 'closed' ? 'selected' : '' }}>
                Closed
            </option>


        </select>


        <button type="submit">
            Update
        </button>


    </form>


</div>


@empty


<p>
    No inquiries yet.
</p>


@endforelse
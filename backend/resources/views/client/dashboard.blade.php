<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Client Dashboard
        </h2>

    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">


                <h3 class="text-lg font-bold">
                    Welcome, {{ auth()->user()->name }}
                </h3>


                <p>
                    Browse commercial properties and manage your inquiries.
                </p>


                <br>


                <a href="{{ route('properties.index') }}" class="inline-flex items-center px-4 py-2 border border-black bg-black text-white rounded-md hover:bg-gray-800 focus:outline-none focus:ring-0">
                    Browse Properties
                </a>


            </div>

        </div>

    </div>

</x-app-layout>
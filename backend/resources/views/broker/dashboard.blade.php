<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Broker Dashboard
        </h2>

    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow rounded-lg p-6">


                <h3 class="text-2xl font-bold text-gray-900">
                    Welcome, {{ auth()->user()->name }}
                </h3>


                <p class="mt-2 text-gray-600">
                    Manage your commercial properties and client inquiries.
                </p>



                <div class="mt-6 flex flex-wrap gap-4">


                    <a href="{{ route('broker.properties.index') }}"
                       class="px-5 py-3 border border-black bg-black text-white rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-0">

                        My Properties

                    </a>



                    <a href="{{ route('broker.inquiries.index') }}"
                       class="px-5 py-3 border border-black bg-white text-black rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-0">

                        My Inquiries

                    </a>


                </div>


            </div>


        </div>

    </div>


</x-app-layout>
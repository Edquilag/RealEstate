<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inquiry for {{ $property->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <form method="POST" action="{{ route('inquiries.store', ['property' => $property->id]) }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                placeholder="Write your inquiry"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            ></textarea>
                        </div>

                        <div>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-black bg-black rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 focus:outline-none focus:ring-0 transition ease-in-out duration-150">
                                Send Inquiry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
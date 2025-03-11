<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Server') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('servers.store') }}" method="POST">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Server Name</label>
                        <input type="text" name="name" class="border-gray-300 rounded-md w-full p-2">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">IP Address</label>
                        <input type="text" name="ip" class="border-gray-300 rounded-md w-full p-2">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Port Number</label>
                        <input type="number" name="port" class="border-gray-300 rounded-md w-full p-2">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Server</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

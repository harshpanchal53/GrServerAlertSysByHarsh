<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Server Details') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                Server Details
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $server->name }}</p>
                <p><strong>IP:</strong> {{ $server->ip }}</p>
                <p><strong>Port:</strong> {{ $server->port }}</p>
                <a href="{{ route('servers.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>


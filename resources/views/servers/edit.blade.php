<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Server') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Server</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('servers.update', $server->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Server Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $server->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="ip" class="form-label">IP Address</label>
                        <input type="text" class="form-control" id="ip" name="ip" value="{{ $server->ip }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="port" class="form-label">Port</label>
                        <input type="number" class="form-control" id="port" name="port" value="{{ $server->port }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Update Server</button>
                    <a href="{{ route('servers.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

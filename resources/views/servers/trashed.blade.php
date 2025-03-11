{{-- @dd("121"); --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trashed Servers') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-warning text-dark d-flex justify-content-between">
                <h4 class="mb-0">Trashed Servers</h4>
                <a href="{{ route('servers.index') }}" class="btn btn-secondary">Back to Servers</a>
            </div>
            <div class="card-body">
                @if($servers->isEmpty())
                    <p class="text-center">No trashed servers found.</p>
                @else
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>IP</th>
                                <th>Port</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($servers as $server)
                            <tr>
                                <td>{{ $server->name }}</td>
                                <td>{{ $server->ip }}</td>
                                <td>{{ $server->port }}</td>
                                <td>
                                    <form method="POST" action="{{ route('servers.restore', $server->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

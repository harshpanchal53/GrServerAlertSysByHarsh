<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Servers') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h4 class="mb-0">Server List</h4>
                <div>
                    <a href="{{ route('servers.create') }}" class="btn btn-success">Add Server</a>
                    <a href="{{ route('servers.trashed') }}" class="btn btn-warning">View Trashed Servers</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>IP</th>
                            <th>Port</th>
                            <th>Status</th>
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
                                <span id="status-{{ $server->id }}" class="badge bg-secondary">Checking...</span>
                            </td>
                            <td>
                                <a href="{{ route('servers.edit', $server->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form method="POST" action="{{ route('servers.destroy', $server->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <script>
                            function updateStatus_{{ $server->id }}() {
                                fetch("{{ route('servers.liveStatus', $server->id) }}")
                                    .then(response => response.json())
                                    .then(data => {
                                        let statusElement = document.getElementById('status-' + data.id);
                                        statusElement.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                                        statusElement.className = "badge " + (data.status === 'online' ? 'bg-success' : 'bg-danger');
                                    });
                            }

                            setInterval(updateStatus_{{ $server->id }}, 2000);
                            updateStatus_{{ $server->id }}();
                        </script>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

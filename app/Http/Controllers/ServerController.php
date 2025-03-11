<?php

namespace App\Http\Controllers;
use App\Models\Server;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $servers = Server::all();
        return view('servers.index', compact('servers'));
    }

    public function create()
    {
        return view('servers.create');
    }

    public function store(Request $request)
    {
        Server::create($request->validate([
            'name' => 'required',
            'ip' => 'required|ip',
            'port' => 'required|integer'
        ]));

        return redirect()->route('servers.index');
    }

    public function edit(Server $server)
    {
        return view('servers.edit', compact('server'));
    }

    public function update(Request $request, Server $server)
    {
        $server->update($request->validate([
            'name' => 'required',
            'ip' => 'required|ip',
            'port' => 'required|integer'
        ]));

        return redirect()->route('servers.index');
    }

    public function destroy(Server $server)
    {
        $server->delete();
        return redirect()->route('servers.index');
    }

    public function trashed()
    {
        $servers = Server::onlyTrashed()->get();
        return view('servers.trashed', compact('servers'));
    }

    public function restore($id)
    {
        $server = Server::onlyTrashed()->findOrFail($id);
        $server->restore();
        return redirect()->route('servers.index');
    }

    public function getLiveStatus($id)
    {
        $server = Server::findOrFail($id);
        $status = $this->checkServerStatus($server->ip, $server->port);
        return response()->json(['id' => $server->id, 'status' => $status]);
    }

    private function checkServerStatus($ip, $port)
    {
        $connection = @fsockopen($ip, $port, $errno, $errstr, 2);
        if ($connection) {
            fclose($connection);
            return 'online';
        }
        return 'offline';
    }
}

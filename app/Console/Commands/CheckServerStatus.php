<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Server;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServerDownNotification;

class CheckServerStatus extends Command
{
    protected $signature = 'servers:check-status';
    protected $description = 'Check all servers and soft delete offline ones, notify users';

    public function handle()
    {
        $servers = Server::all();

        foreach ($servers as $server) {
            $status = $this->checkServerStatus($server->ip, $server->port);

            if ($status === 'offline') {
                if (!$server->deleted_at) { // Only trigger if not already soft deleted
                    $server->delete(); // Soft delete

                    // Notify all registered users
                    $users = User::all();
                    foreach ($users as $user) {
                        Mail::to($user->email)->send(new ServerDownNotification($server));
                    }

                    $this->info("Server '{$server->name}' is offline and has been soft deleted. Users notified.");
                }
            } else {
                $server->restore(); // Restore if it's back online
                $this->info("Server '{$server->name}' is online.");
            }
        }

        return Command::SUCCESS;
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

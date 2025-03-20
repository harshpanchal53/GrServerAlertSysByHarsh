<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Server;

class ServerDownNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function build()
    {
        return $this->subject("Alert: Server {$this->server->name} is Offline")
                    ->view('emails.server_down')
                    ->with([
                        'serverName' => $this->server->name,
                        'serverIp' => $this->server->ip,
                        'serverPort' => $this->server->port,
                    ]);
    }
}

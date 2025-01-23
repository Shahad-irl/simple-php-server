<?php

namespace vrDOM\station\PHPServer;

use vrDOM\station\PHPServer\Exception;
use vrDOM\station\PHPServer\Request;
use vrDOM\station\PHPServer\Response;

class Server
{
    /**
     * The current host
     *
     * @var string
     */
    protected string $host;

    /**
     * The current port
     *
     * @var int
     */
    protected int $port;

    /**
     * The binded socket
     * 
     * @var \Socket|null
     */
    protected ?\Socket $socket = null;

    public function __construct(string $host, int $port)
    {
        $this->host = $host;
        $this->port = $port;

        $this->createSocket();
        $this->bind();
    }

    protected function createSocket(): void
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if (!$this->socket) {
            throw new Exception('Failed to create socket: ' . socket_strerror(socket_last_error()));
        }
    }

    protected function bind(): void
    {
        if (!socket_bind($this->socket, $this->host, $this->port)) {
            throw new Exception(
                sprintf(
                    'Could not bind to %s:%d - %s',
                    $this->host,
                    $this->port,
                    socket_strerror(socket_last_error())
                )
            );
        }
    }

    public function listen(callable $callback): void
    {
        if (!is_callable($callback)) {
            throw new Exception('The given argument should be callable.');
        }

        while (true) {
            socket_listen($this->socket);

            $client = socket_accept($this->socket);
            if (!$client) {
                continue;
            }

            $header = socket_read($client, 4096);
            if (!$header) {
                socket_close($client);
                continue;
            }

            $request = Request::withHeaderString($header);
            $response = $callback($request);

            if (!$response instanceof Response) {
                $response = Response::error(404);
            }

            $responseString = (string) $response;
            socket_write($client, $responseString, strlen($responseString));
            socket_close($client);
        }
    }
}

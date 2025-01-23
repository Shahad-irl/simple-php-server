<?php

/**
 * Server class for handling HTTP requests and sending responses.
 */
class Server
{
    private Response $response;

    /**
     * Initialize the Server with a Response instance.
     */
    public function __construct()
    {
        $this->response = new Response();
    }

    /**
     * Handle an incoming HTTP request.
     */
    public function handleRequest(): void
    {
        // Example handling logic
        $this->response->setStatusCode(200);
        $this->response->addHeader('Content-Type', 'application/json');
        $this->response->setBody(json_encode(['message' => 'Hello, world!']));
        $this->response->send();
    }
}

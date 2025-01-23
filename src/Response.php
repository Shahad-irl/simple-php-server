<?php

/**
 * Response class for managing HTTP responses.
 */
class Response
{
    private int $statusCode;
    private array $headers = [];
    private string $body = '';

    /**
     * Set the HTTP status code.
     *
     * @param int $code The HTTP status code.
     */
    public function setStatusCode(int $code): void
    {
        $this->statusCode = $code;
    }

    /**
     * Add or replace a header.
     *
     * @param string $name The name of the header.
     * @param string $value The value of the header.
     */
    public function addHeader(string $name, string $value): void
    {
        $this->headers[$name] = $value;
    }

    /**
     * Set the response body.
     *
     * @param string $body The content of the response body.
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * Send the HTTP response.
     */
    public function send(): void
    {
        if (isset($this->statusCode)) {
            http_response_code($this->statusCode);
        }

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        echo $this->body;
    }
}

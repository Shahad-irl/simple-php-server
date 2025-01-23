<?php

namespace vrDOM\station\PHPServer;

use vrDOM\station\PHPServer\Exception;

/**
 * Handles HTTP requests and their associated data.
 */
class Request
{
    /**
     * The request method.
     *
     * @var string
     */
    protected ?string $method = null;

    /**
     * The request URI.
     *
     * @var string
     */
    protected ?string $uri = null;

    /**
     * The request parameters.
     *
     * @var array
     */
    protected array $parameters = [];

    /**
     * The request headers.
     *
     * @var array
     */
    protected array $headers = [];

    /**
     * Create a new Request instance using a string header.
     *
     * @param string $header
     * @return Request
     */
    public static function withHeaderString(string $header): Request
    {
        $lines = explode("\n", $header);

        // Extract method and URI
        [$method, $uri] = explode(' ', array_shift($lines), 2);

        $headers = [];

        foreach ($lines as $line) {
            $line = trim($line);

            if (strpos($line, ': ') !== false) {
                [$key, $value] = explode(': ', $line, 2);
                $headers[$key] = $value;
            }
        }

        // Create a new Request object
        return new static($method, $uri, $headers);
    }

    /**
     * Request constructor.
     *
     * @param string $method
     * @param string $uri
     * @param array $headers
     */
    public function __construct(string $method, string $uri, array $headers = [])
    {
        $this->headers = $headers;
        $this->method = strtoupper($method);

        // Split URI and parameter string
        [$this->uri, $params] = array_pad(explode('?', $uri, 2), 2, '');

        // Parse the parameters
        parse_str($params, $this->parameters);
    }

    /**
     * Get the request method.
     *
     * @return string
     */
    public function method(): string
    {
        return $this->method;
    }

    /**
     * Get the request URI.
     *
     * @return string
     */
    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * Get a request header.
     *
     * @param string $key
     * @param mixed $default
     * @return string|null
     */
    public function header(string $key, $default = null): ?string
    {
        return $this->headers[$key] ?? $default;
    }

    /**
     * Get a request parameter.
     *
     * @param string $key
     * @param mixed $default
     * @return string|null
     */
    public function param(string $key, $default = null): ?string
    {
        return $this->parameters[$key] ?? $default;
    }
}

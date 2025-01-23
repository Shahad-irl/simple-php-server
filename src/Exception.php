<?php

namespace vrDOM\station\PHPServer;

/**
 * Custom Exception class for the PHPServer namespace.
 */
class Exception extends \Exception
{
    /**
     * Override the constructor to allow for custom messages and codes.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Return a formatted string representation of the exception.
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf("[%s] %s: %s in %s on line %d", $this->code, __CLASS__, $this->message, $this->file, $this->line);
    }
}

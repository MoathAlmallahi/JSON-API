<?php

namespace Json\Exceptions;

/**
 * Class InvalidErrorSourceException
 * @package Json\Exceptions
 */
class InvalidErrorSourceException extends \Exception
{

    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Invalid error source',
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
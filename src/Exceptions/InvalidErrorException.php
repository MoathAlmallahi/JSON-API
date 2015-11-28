<?php

namespace Json\Exceptions;

/**
 * Class InvalidErrorException
 * @package Json\Exceptions
 */
class InvalidErrorException extends \Exception
{

    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Error object should contain at least one parameter set',
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
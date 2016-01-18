<?php

namespace Json\Exceptions;

/**
 * Class InvalidMetaException
 * @package Json\Exceptions
 */
class InvalidMetaException extends \Exception
{

    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Invalid Meta value, can be only of type string or array',
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
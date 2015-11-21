<?php

namespace Json\Exceptions;

/**
 * Class InvalidLinkException
 * @package Json\Exceptions
 */
class InvalidLinkException extends \Exception
{

    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Link object should contain at least Href or Meta',
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
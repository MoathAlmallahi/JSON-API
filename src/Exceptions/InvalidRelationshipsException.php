<?php

namespace Json\Exceptions;

/**
 * Class InvalidRelationshipsException
 * @package Json\Exceptions
 */
class InvalidRelationshipsException extends \Exception
{

    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Relationships object should contain at least Links, Meta or Data',
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
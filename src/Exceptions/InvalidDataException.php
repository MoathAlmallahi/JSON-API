<?php

namespace Json\Exceptions;

/**
 * Class InvalidJsonApiDocument
 * @package Json\Exceptions
 */
class InvalidDataException extends \Exception
{

    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Trying to set an invalid JsonApi document, $type or $id should be set.',
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
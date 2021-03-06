<?php

namespace Json\Exceptions;

/**
 * Class InvalidJsonApiDocument
 * @package Json\Exceptions
 */
class InvalidJsonApiDocumentException extends \Exception
{

    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Trying to set an invalid JsonApi document, document should have $meta, $links or errors',
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
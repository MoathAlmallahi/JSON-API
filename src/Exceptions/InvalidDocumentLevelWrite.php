<?php

namespace Json\Exceptions;

/**
 * Class InvalidCollectionItemTypeException
 * @package Json\Exceptions
 */
class InvalidDocumentLevelWrite extends \Exception
{

    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Trying to append object of top level into an upper level',
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
<?php

namespace Json\Object\Error;

use Json\Object\Error;
use Json\Object\AbstractCollection;

/**
 * Class Collection
 * @package Json\Object\Error
 */
class Collection extends AbstractCollection
{

    const COLLECTION_NAME = 'errors';

    /**
     * @param Error $element
     * @return bool
     */
    protected function validateType($element)
    {
        return ($element instanceof Error);
    }
}

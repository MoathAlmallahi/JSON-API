<?php

namespace Json\Document\Error;

use Json\Document\Error;
use Json\Document\AbstractCollection;

/**
 * Class Collection
 * @package Json\Document\Error
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

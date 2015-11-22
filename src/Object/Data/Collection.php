<?php

namespace Json\Object\Data;

use Json\Object\Data;
use Json\Object\AbstractCollection;

/**
 * Class Collection
 * @package Json\Object\Data
 */
class Collection extends AbstractCollection
{
    const COLLECTION_NAME = 'data';

    /**
     * @param Data $element
     * @return bool
     */
    protected function validateType($element)
    {
        return ($element instanceof Data);
    }
}

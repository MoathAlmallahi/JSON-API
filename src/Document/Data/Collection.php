<?php

namespace Json\Document\Data;

use Json\Document\Data;
use Json\Document\AbstractCollection;

/**
 * Class Collection
 * @package Json\Document\Data
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

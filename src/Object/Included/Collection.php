<?php

namespace Json\Object\Included;

use Json\Object\AbstractCollection;
use Json\Object\Data;

/**
 * Class Collection
 * @package Json\Object\Included
 */
class Collection extends AbstractCollection
{
    const COLLECTION_NAME = 'included';
    /**
     * @param Data\Collection $element
     * @return bool
     */
    protected function validateType($element)
    {
        return ($element instanceof Data);
    }
}

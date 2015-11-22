<?php

namespace Json\Document\Included;

use Json\Document\AbstractCollection;
use Json\Document\Data;

/**
 * Class Collection
 * @package Json\Document\Included
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

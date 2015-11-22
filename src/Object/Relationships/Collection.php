<?php

namespace Json\Object\Relationships;

use Json\Object\AbstractCollection;
use Json\Object\Relationships;

/**
 * Class Collection
 * @package Json\Object\Relationships
 */
class Collection extends AbstractCollection
{
    const COLLECTION_NAME = 'relationships';

    /**
     * @param Relationships $element
     * @return bool
     */
    protected function validateType($element)
    {
        return ($element instanceof Relationships);
    }
}

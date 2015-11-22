<?php

namespace Json\Document\Relationships;

use Json\Document\AbstractCollection;
use Json\Document\Relationships;

/**
 * Class Collection
 * @package Json\Document\Relationships
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

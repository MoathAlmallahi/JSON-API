<?php

namespace Json\Object\Links;

use Json\Object\AbstractCollection;
use Json\Object\Links;

/**
 * Class Collection
 * @package Json\Object\Links
 */
class Collection extends AbstractCollection
{
    const COLLECTION_NAME = 'links';

    /**
     * @param Links $element
     * @return bool
     */
    protected function validateType($element)
    {
        return ($element instanceof Links);
    }
}

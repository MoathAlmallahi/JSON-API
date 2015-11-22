<?php

namespace Json\Document\Links;

use Json\Document\AbstractCollection;
use Json\Document\Links;

/**
 * Class Collection
 * @package Json\Document\Links
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

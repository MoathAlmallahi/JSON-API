<?php

namespace Json\Document\Meta;

use Json\Document\AbstractCollection;
use Json\Document\Meta;

/**
 * Class Collection
 * @package Json\Document\Meta
 */
class Collection extends AbstractCollection
{
    const COLLECTION_NAME = 'meta';

    /**
     * @param Meta $element
     * @return bool
     */
    protected function validateType($element)
    {
        return ($element instanceof Meta);
    }
}

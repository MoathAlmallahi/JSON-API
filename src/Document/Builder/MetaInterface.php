<?php

namespace Json\Document\Builder;

use Json\Document\IBuilder;
use Json\Document\Meta;

/**
 * Interface MetaInterface
 * @package Json\Document\Builder
 */
interface MetaInterface extends IBuilder
{
    /**
     * @return Meta\Builder
     */
    public function getMetaCollectionBuilder();

    /**
     * @param Meta\Collection $metaCollection
     * @return static
     */
    public function setMetaCollection(Meta\Collection $metaCollection);
}

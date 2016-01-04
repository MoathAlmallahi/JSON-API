<?php

namespace Json\Document\Builder;

use Json\Document\IBuilder;
use Json\Document\Included;

/**
 * Interface IncludedInterface
 * @package Json\Document\Builder
 */
interface IncludedInterface extends IBuilder
{
    /**
     * @return Included\Builder
     */
    public function getIncludedCollectionBuilder();

    /**
     * @param Included\Collection $includedCollection
     * @return static
     */
    public function setIncludedCollection(Included\Collection $includedCollection);
}

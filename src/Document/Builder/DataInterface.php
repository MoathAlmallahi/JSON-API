<?php

namespace Json\Document\Builder;

use Json\Document\Data;
use Json\Document\IBuilder;

/**
 * Interface DataInterface
 * @package Json\Document\Builder
 */
interface DataInterface extends IBuilder
{
    /**
     * @return Data\Builder
     */
    public function getDataCollectionBuilder();

    /**
     * @param Data\Collection $dataCollection
     * @return static
     */
    public function setDataCollection(Data\Collection $dataCollection);
}

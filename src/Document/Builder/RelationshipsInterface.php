<?php

namespace Json\Document\Builder;

use Json\Document\IBuilder;
use Json\Document\Relationships;

/**
 * Interface RelationshipsInterface
 * @package Json\Document\Builder
 */
interface RelationshipsInterface extends IBuilder
{
    /**
     * @return Relationships\Builder
     */
    public function getRelationshipsCollectionBuilder();

    /**
     * @param Relationships\Collection $relationshipsCollection
     * @return static
     */
    public function setRelationshipsCollection(Relationships\Collection $relationshipsCollection);
}

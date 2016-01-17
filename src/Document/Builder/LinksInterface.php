<?php

namespace Json\Document\Builder;

use Json\Document\IBuilder;
use Json\Document\Links;

/**
 * Interface LinksInterface
 * @package Json\Document\Builder
 */
interface LinksInterface extends IBuilder
{
    /**
     * @return Links\Builder
     */
    public function getLinksCollectionBuilder();

    /**
     * @param Links\Collection $linksCollection
     * @return static
     */
    public function setLinksCollection(Links\Collection $linksCollection);
}

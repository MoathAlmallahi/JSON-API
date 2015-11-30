<?php

namespace Json;

use Json\Document\Links\Collection as LinksCollection;
use Json\Document\Meta\Collection as MetaCollection;
use Json\Document\Relationships\Collection as RelationshipsCollection;

/**
 * Interface ISkeleton
 * @package Json
 */
interface ISkeleton
{

    /**
     * @return string
     */
    public function getType();

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return array|null
     */
    public function getAttributes();

    /**
     * @return RelationshipsCollection|null
     */
    public function getRelationshipsCollection();

    /**
     * @return LinksCollection|null
     */
    public function getLinksCollection();

    /**
     * @return MetaCollection|null
     */
    public function getMetaCollection();
}

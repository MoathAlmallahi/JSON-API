<?php

namespace Json\Null;

use Json\ISkeleton;
use Json\Object\Links\Collection as LinksCollection;
use Json\Object\Meta\Collection as MetaCollection;
use Json\Object\Relationships\Collection as RelationshipsCollection;
use Json\IIRecursively;

/**
 * Class Null
 * @package Json
 */
class Data implements ISkeleton, IIRecursively
{

    /**
     * @return string
     */
    public function getType()
    {
        return null;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return null;
    }

    /**
     * @return array|null
     */
    public function getAttributes()
    {
        return null;
    }

    /**
     * @return RelationshipsCollection|null
     */
    public function getRelationships()
    {
        return null;
    }

    /**
     * @return LinksCollection|null
     */
    public function getLinks()
    {
        return null;
    }

    /**
     * @return MetaCollection|null
     */
    public function getMeta()
    {
        return null;
    }

    /**
     * Returns json encoded value or null
     * @return string|null
     */
    public function getAsJson()
    {
        return null;
    }
}
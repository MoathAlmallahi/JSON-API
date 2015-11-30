<?php

namespace Json\Null;

use Json\ISkeleton;
use Json\Document\Links\Collection as LinksCollection;
use Json\Document\Meta\Collection as MetaCollection;
use Json\Document\Relationships\Collection as RelationshipsCollection;
use Json\IRecursively;

/**
 * Class Null
 * @package Json
 */
class Data implements ISkeleton, IRecursively
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
    public function getRelationshipsCollection()
    {
        return null;
    }

    /**
     * @return LinksCollection|null
     */
    public function getLinksCollection()
    {
        return null;
    }

    /**
     * @return MetaCollection|null
     */
    public function getMetaCollection()
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

    /**
     * Returns the json as array
     * @return array
     */
    public function getAsArray()
    {
        return null;
    }
}
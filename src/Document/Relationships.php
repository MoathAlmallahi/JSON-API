<?php

namespace Json\Document;

use Json\Exceptions\InvalidRelationshipsException;
use Json\IRecursively;
use Json\Document\Data\Collection as DataCollection;
use Json\Document\Links\Collection as LinksCollection;
use Json\Document\Meta\Collection as MetaCollection;

/**
 * Class Relationships
 * @package Json\Document
 */
class Relationships implements IRecursively
{
    const FIELD_NAME = 'name';
    const FIELD_LINKS = Data::FIELD_LINKS;
    const FIELD_DATA = Data::FIELD_DATA;
    const FIELD_META = Data::FIELD_META;

    /**
     * @var LinksCollection|null
     */
    private $linksCollection;

    /**
     * @var DataCollection|null
     */
    private $dataCollection;

    /**
     * @var MetaCollection|null
     */
    private $metaCollection;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     * @param LinksCollection|null $linksCollection
     * @param DataCollection|null $dataCollection
     * @param MetaCollection|null $metaCollection
     * @throws InvalidRelationshipsException
     */
    public function __construct(
        $name,
        LinksCollection $linksCollection = null,
        DataCollection $dataCollection = null,
        MetaCollection $metaCollection = null
    ) {
        if (
            (null === $linksCollection && null === $dataCollection && null === $metaCollection) ||
            !is_string($name)
        ) {
            throw new InvalidRelationshipsException;
        }
        $this->name = $name;
        $this->linksCollection = $linksCollection;
        $this->dataCollection = $dataCollection;
        $this->metaCollection = $metaCollection;
    }

    /**
     * @return LinksCollection|null
     */
    public function getLinksCollection()
    {
        return $this->linksCollection;
    }

    /**
     * @return DataCollection|null
     */
    public function getDataCollection()
    {
        return $this->dataCollection;
    }

    /**
     * @return MetaCollection|null
     */
    public function getMetaCollection()
    {
        return $this->metaCollection;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns json encoded value or null
     * @return string|null
     */
    public function getAsJson()
    {
        return json_encode($this->getAsArray());
    }

    /**
     * Returns the json as array
     * @return array
     */
    public function getAsArray()
    {
        $relationshipsArray[Data::FIELD_LINKS] = null !== $this->getLinksCollection() ?
            $this->getLinksCollection()->getAsArray() : null;
        $relationshipsArray[Data::FIELD_DATA] = null !== $this->getDataCollection() ?
            $this->getDataCollection()->getAsArray() : null;
        $relationshipsArray[Data::FIELD_META] = null !== $this->getMetaCollection() ?
            $this->getMetaCollection()->getAsArray() : null;

        return [$this->getName() => array_filter($relationshipsArray)];
    }
}

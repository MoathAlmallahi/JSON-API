<?php

namespace Json\Document\Included;

use Json\Document;
use Json\Exceptions\InvalidDocumentLevelWrite;
use Json\IFactory;

/**
 * Class Builder
 * @package Json\Document\Included
 */
class Builder implements Document\Builder\LinksInterface, Document\Builder\MetaInterface, Document\Builder\RelationshipsInterface
{
    /**
     * @var IFactory
     */
    private $factory;

    /**
     * @var Document\Builder
     */
    private $builder;

    /**
     * The JSON Document included structure
     * @var array
     */
    private $structure;

    /**
     * @var Document\Included[]
     */
    private $includedCollection = [];

    /**
     * @param IFactory $factory
     * @param Document\IBuilder $builder
     */
    public function __construct(IFactory $factory, Document\IBuilder $builder = null)
    {
        $this->factory = $factory;
        $this->builder = $builder;
        $this->resetStructure();
    }

    /**
     * Sets the included document type
     * @param string $type
     * @return Builder
     */
    public function setType($type)
    {
        $this->structure[Document\Included::FIELD_TYPE] = $type;

        return $this;
    }

    /**
     * Sets the included document type
     * @param mixed $id
     * @return Builder
     */
    public function setId($id)
    {
        $this->structure[Document\Included::FIELD_ID] = $id;

        return $this;
    }

    /**
     * @param string $name
     * @param string|array $value
     * @return Builder
     */
    public function setAttribute($name, $value)
    {
        $this->structure[Document\Included::FIELD_ATTRIBUTES][$name] = $value;

        return $this;
    }

    /**
     * @param array $attributes
     * @return Builder
     */
    public function setAttributes(array $attributes)
    {
        $this->structure[Document\Included::FIELD_ATTRIBUTES] = $attributes;

        return $this;
    }

    /**
     * @return Document\Relationships\Builder
     */
    public function getRelationshipsCollectionBuilder()
    {
        return new Document\Relationships\Builder($this->factory, $this);
    }

    /**
     * @param Document\Relationships\Collection $relationshipsCollection
     * @return Builder
     */
    public function setRelationshipsCollection(Document\Relationships\Collection $relationshipsCollection)
    {
        $this->structure[Document\Included::FIELD_RELATIONSHIPS] = $relationshipsCollection;

        return $this;
    }

    /**
     * @return Document\Links\Builder
     */
    public function getLinksCollectionBuilder()
    {
        return new Document\Links\Builder($this->factory, $this);
    }

    /**
     * @param Document\Links\Collection $linksCollection
     * @return Builder
     */
    public function setLinksCollection(Document\Links\Collection $linksCollection)
    {
        $this->structure[Document\Included::FIELD_LINKS] = $linksCollection;

        return $this;
    }

    /**
     * @return Document\Meta\Builder
     */
    public function getMetaCollectionBuilder()
    {
        return new Document\Meta\Builder($this->factory, $this);
    }

    /**
     * @param Document\Meta\Collection $metaCollection
     * @return Builder
     */
    public function setMetaCollection(Document\Meta\Collection $metaCollection)
    {
        $this->structure[Document\Included::FIELD_META] = $metaCollection;

        return $this;
    }

    /**
     * @return Builder
     */
    public function addIncluded()
    {
        $this->includedCollection[] = $this->factory->createIncluded(
            $this->structure[Document\Included::FIELD_TYPE],
            $this->structure[Document\Included::FIELD_ID],
            $this->structure[Document\Included::FIELD_ATTRIBUTES],
            $this->structure[Document\Included::FIELD_RELATIONSHIPS],
            $this->structure[Document\Included::FIELD_LINKS],
            $this->structure[Document\Included::FIELD_META]
        );
        $this->resetStructure();

        return $this;
    }

    /**
     * @return void
     */
    private function resetStructure()
    {
        $this->structure = [
            Document\Included::FIELD_TYPE => null,
            Document\Included::FIELD_ID => null,
            Document\Included::FIELD_ATTRIBUTES => null,
            Document\Included::FIELD_RELATIONSHIPS => null,
            Document\Included::FIELD_LINKS => null,
            Document\Included::FIELD_META => null
        ];
    }

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @throws InvalidDocumentLevelWrite
     * @return Document\Builder
     */
    public function addToParent()
    {
        $this->builder->setIncludedCollection(
            $this->factory->createIncludedCollection($this->includedCollection)
        );

        return $this->builder;
    }
}

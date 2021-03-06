<?php

namespace Json\Document\Data;

use Json\Document\Data;
use Json\Document;
use Json\Document\IBuilder;
use Json\Exceptions\InvalidDocumentLevelWrite;
use Json\IFactory;
use Json\Document\Meta;
use Json\Document\Links;
use Json\Document\Relationships;

/**
 * Class Builder
 * @package Json\Data
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
     * The JSON Document data structure
     * @var array
     */
    private $structure;

    /**
     * @var Data[]
     */
    private $dataCollection = [];

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
     * Sets the data document type
     * @param string $type
     * @return Builder
     */
    public function setType($type)
    {
        $this->structure[Data::FIELD_TYPE] = $type;

        return $this;
    }

    /**
     * Sets the data document type
     * @param mixed $id
     * @return Builder
     */
    public function setId($id)
    {
        $this->structure[Data::FIELD_ID] = $id;

        return $this;
    }

    /**
     * @param string $name
     * @param string|array $value
     * @return Builder
     */
    public function setAttribute($name, $value)
    {
        $this->structure[Data::FIELD_ATTRIBUTES][$name] = $value;

        return $this;
    }

    /**
     * @param array $attributes
     * @return Builder
     */
    public function setAttributes(array $attributes)
    {
        $this->structure[Data::FIELD_ATTRIBUTES] = $attributes;

        return $this;
    }

    /**
     * @return Relationships\Builder
     */
    public function getRelationshipsCollectionBuilder()
    {
        return new Relationships\Builder($this->factory, $this);
    }

    /**
     * @param Relationships\Collection $relationshipsCollection
     * @return Builder
     */
    public function setRelationshipsCollection(Relationships\Collection $relationshipsCollection)
    {
        $this->structure[Data::FIELD_RELATIONSHIPS] = $relationshipsCollection;

        return $this;
    }

    /**
     * @return Links\Builder
     */
    public function getLinksCollectionBuilder()
    {
        return new Links\Builder($this->factory, $this);
    }

    /**
     * @param Links\Collection $linksCollection
     * @return Builder
     */
    public function setLinksCollection(Links\Collection $linksCollection)
    {
        $this->structure[Data::FIELD_LINKS] = $linksCollection;

        return $this;
    }

    /**
     * @return Meta\Builder
     */
    public function getMetaCollectionBuilder()
    {
        return new Meta\Builder($this->factory, $this);
    }

    /**
     * @param Meta\Collection $metaCollection
     * @return Builder
     */
    public function setMetaCollection(Meta\Collection $metaCollection)
    {
        $this->structure[Data::FIELD_META] = $metaCollection;

        return $this;
    }

    /**
     * @return Builder
     */
    public function addData()
    {
        $this->dataCollection[] = $this->factory->createData(
            $this->structure[Data::FIELD_TYPE],
            $this->structure[Data::FIELD_ID],
            $this->structure[Data::FIELD_ATTRIBUTES],
            $this->structure[Data::FIELD_RELATIONSHIPS],
            $this->structure[Data::FIELD_LINKS],
            $this->structure[Data::FIELD_META]
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
            Data::FIELD_TYPE => null,
            Data::FIELD_ID => null,
            Data::FIELD_ATTRIBUTES => null,
            Data::FIELD_RELATIONSHIPS => null,
            Data::FIELD_LINKS => null,
            Data::FIELD_META => null
        ];
    }

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @throws InvalidDocumentLevelWrite
     * @return Document\Builder\DataInterface
     */
    public function addToParent()
    {
        $this->builder->setDataCollection(
            $this->factory->createDataCollection($this->dataCollection)
        );

        return $this->builder;
    }
}

<?php

namespace Json\Document\Relationships;

use Json\Document;
use Json\Document\Builder\DataInterface;
use Json\Document\Builder\LinksInterface;
use Json\Document\Builder\MetaInterface;
use Json\Document\IBuilder;
use Json\Document\Links;
use Json\Document\Meta;
use Json\Document\Data;
use Json\Document\Relationships;
use Json\Exceptions\InvalidDocumentLevelWrite;
use Json\IFactory;

/**
 * Class Builder
 * @package Json\Document\Relationships
 */
class Builder implements LinksInterface, DataInterface, MetaInterface
{
    /**
     * @var IFactory
     */
    private $factory;

    /**
     * @var \Json\Document\Data\Builder|IBuilder|null
     */
    private $builder;

    /**
     * @var Relationships[]
     */
    private $relationships;

    /**
     * @var array
     */
    private $structure;

    /**
     * @param IFactory $factory
     * @param \JSon\Document\Data\Builder|IBuilder|null $builder
     */
    public function __construct(IFactory $factory, IBuilder $builder = null)
    {
        $this->factory = $factory;
        $this->builder = $builder;
        $this->resetStructure();
    }

    /**
     * @param string $name
     * @return Builder
     */
    public function setName($name)
    {
        $this->structure[Relationships::FIELD_NAME] = (string) $name;

        return $this;
    }

    /**
     * @return Builder
     */
    public function addRelationships()
    {
        $this->relationships[$this->structure[Relationships::FIELD_NAME]] = $this->factory->createRelationships(
            $this->structure[Relationships::FIELD_NAME],
            $this->structure[Relationships::FIELD_LINKS],
            $this->structure[Relationships::FIELD_DATA],
            $this->structure[Relationships::FIELD_META]
        );
        $this->resetStructure();

        return $this;
    }

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @throws InvalidDocumentLevelWrite
     * @return IBuilder
     */
    public function addToParent()
    {
        $this->builder->setRelationshipsCollection(
            $this->factory->createRelationshipsCollection(
                $this->relationships
            )
        );
        $this->resetStructure();

        return $this->builder;
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
        $this->structure[Relationships::FIELD_LINKS] = $linksCollection;

        return $this;
    }

    /**
     * @return void
     */
    private function resetStructure()
    {
        $this->structure = [
            Relationships::FIELD_NAME => null,
            Relationships::FIELD_META => null,
            Relationships::FIELD_DATA => null,
            Relationships::FIELD_LINKS => null
        ];
    }

    /**
     * @return Data\Builder
     */
    public function getDataCollectionBuilder()
    {
        return new Document\Data\Builder($this->factory, $this);
    }

    /**
     * @param Data\Collection $dataCollection
     * @return static
     */
    public function setDataCollection(Data\Collection $dataCollection)
    {
        $this->structure[Relationships::FIELD_DATA] = $dataCollection;

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
     * @return static
     */
    public function setMetaCollection(Meta\Collection $metaCollection)
    {
        $this->structure[Relationships::FIELD_META] = $metaCollection;

        return $this;
    }
}

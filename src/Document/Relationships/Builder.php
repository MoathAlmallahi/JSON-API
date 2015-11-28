<?php

namespace Json\Document\Relationships;

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
class Builder implements IBuilder
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
     * @param IFactory $factory
     * @param \JSon\Document\Data\Builder|IBuilder|null $builder
     */
    public function __construct(IFactory $factory, IBuilder $builder = null)
    {
        $this->factory = $factory;
        $this->builder = $builder;
    }

    /**
     * @param $name
     * @param Links\Collection $linksCollection
     * @param Data\Collection $dataCollection
     * @param Meta\Collection $metaCollection
     */
    public function addRelationships(
        $name,
        Links\Collection $linksCollection,
        Data\Collection $dataCollection,
        Meta\Collection $metaCollection
    ) {
        $this->relationships[$name] = $this->factory->createRelationships(
            $name, $linksCollection, $dataCollection, $metaCollection
        );
    }

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @throws InvalidDocumentLevelWrite
     * @return IBuilder
     */
    public function addToParent()
    {
        $this->builder->addRelationshipsCollection(
            $this->factory->createRelationshipsCollection(
                $this->relationships
            )
        );
    }
}
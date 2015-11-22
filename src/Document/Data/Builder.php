<?php

namespace Json\Document\Data;

use Json\Document\Data;
use Json\Document;
use Json\Document\IBuilder;
use Json\Exceptions\InvalidDocumentLevelWrite;
use Json\IFactory;
use Json\Document\Meta;

/**
 * Class Builder
 * @package Json\Data
 */
class Builder implements Document\IBuilder
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
    private $structure = [
        Data::FIELD_TYPE => null,
        Data::FIELD_ID => null,
        Data::FIELD_ATTRIBUTES => null,
        Data::FIELD_RELATIONSHIPS => [],
        Data::FIELD_LINKS => [],
        Data::FIELD_META => []
    ];

    /**
     * @param IFactory $factory
     * @param Document\IBuilder $builder
     */
    public function __construct(IFactory $factory, Document\IBuilder $builder = null)
    {
        $this->factory = $factory;
        $this->builder = $builder;
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
     * @param string $name
     * @param Document\Relationships\Collection $relationshipsCollection
     * @return Builder
     */
    public function addRelationships(
        $name,
        Document\Relationships\Collection $relationshipsCollection
    ) {
        $this->structure[Data::FIELD_RELATIONSHIPS][$name] = $this->factory->createRelationships(
            $name,
            $relationshipsCollection
        );

        return $this;
    }

    /**
     * @return Document\Links\Builder
     */
    public function getLinksBuilder()
    {
        return new Document\Links\Builder($this->factory, $this);
    }

    /**
     * @param Document\Links\Collection $linksCollection
     * @return Builder
     */
    public function addLinks(Document\Links\Collection $linksCollection)
    {
        $this->structure[Data::FIELD_LINKS] = $linksCollection;

        return $this;
    }

    /**
     * @param Meta\Collection $metaCollection
     * @return Builder
     */
    public function addMeta(Meta\Collection $metaCollection)
    {
        $this->structure[Data::FIELD_META] = $metaCollection;

        return $this;
    }

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @throws InvalidDocumentLevelWrite
     * @return IBuilder
     */
    public function addToParent()
    {
        $this->builder->addData(
            $this->factory->createDataCollection($this->structure)
        );
    }
}

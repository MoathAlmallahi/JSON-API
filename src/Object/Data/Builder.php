<?php

namespace Json\Object\Data;

use Json\Object\Data;
use Json\Object;
use Json\IFactory;
use Json\Object\Meta;

/**
 * Class Builder
 * @package Json\Data
 */
class Builder
{

    /**
     * @var IFactory
     */
    private $factory;

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
     */
    public function __construct(IFactory $factory)
    {
        $this->factory = $factory;
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
     * @param Object\Links\Collection|null $linksCollection
     * @param Object\Data\Collection|null $dataCollection
     * @param Object\Meta\Collection|null $metaCollection
     * @return Builder
     */
    public function addRelationships(
        $name,
        Object\Links\Collection $linksCollection = null,
        Object\Data\Collection $dataCollection = null,
        Object\Meta\Collection $metaCollection = null
    ) {
        $this->structure[Data::FIELD_RELATIONSHIPS][$name] = $this->factory->createRelationships(
            $name,
            $linksCollection,
            $dataCollection,
            $metaCollection
        );

        return $this;
    }

    /**
     * @param string $name
     * @param string $href
     * @param Meta|null $meta
     * @return Builder
     */
    public function addLinks($name, $href, Meta $meta = null)
    {
        $this->structure[Data::FIELD_LINKS][] = $this->factory->createLinks($name, $href, $meta);

        return $this;
    }

    /**
     * @param string $name
     * @param string|array $value
     * @return Builder
     */
    public function addMeta($name, $value)
    {
        $this->structure[Data::FIELD_META][] = $this->factory->createMeta($name, $value);

        return $this;
    }
}

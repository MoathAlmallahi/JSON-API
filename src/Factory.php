<?php

namespace Json;

use Json\Exceptions\InvalidLinkException;
use Json\Object\Links;
use Json\Object\Meta;
use Json\Object\Data;
use Json\Object\Relationships;
use Json\Object\Error\Source;

/**
 * Class Factory
 * @package Json
 */
class Factory implements IFactory
{

    /**
     * @param string $name
     * @param string $href
     * @param Object\Meta\Collection $meta
     * @throws InvalidLinkException
     * @return Links
     */
    public function createLinks($name, $href, Object\Meta\Collection $meta = null)
    {
        return new Links($name, $href, $meta);
    }

    /**
     * @param string $name
     * @param string|array $value
     * @return Meta
     */
    public function createMeta($name, $value)
    {
        return new Meta($name, $value);
    }

    /**
     * @param string $name
     * @param Links\Collection|null $linksCollection
     * @param Data\Collection|null $dataCollection
     * @param Meta\Collection|null $metaCollection
     * @return Relationships
     */
    public function createRelationships(
        $name,
        Links\Collection $linksCollection = null,
        Data\Collection $dataCollection = null,
        Meta\Collection $metaCollection = null
    ) {
        return new Relationships($name, $linksCollection, $dataCollection, $metaCollection);
    }

    /**
     * @param string $pointer
     * @param string $parameters
     * @return Source
     */
    public function createSource($pointer, $parameters)
    {
        return new Source($pointer, $parameters);
    }

    /**
     * @param Data[] $data
     * @return Data\Collection
     */
    public function createDataCollection(array $data)
    {
        return new Data\Collection($data);
    }

    /**
     * @param Links[] $links
     * @return Links\Collection
     */
    public function createLinksCollection(array $links)
    {
        return new Links\Collection($links);
    }

    /**
     * @param Meta[] $metaArray
     * @return Meta\Collection
     */
    public function createMetaCollection(array $metaArray)
    {
        return new Meta\Collection($metaArray);
    }
}

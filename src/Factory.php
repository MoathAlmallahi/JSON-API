<?php

namespace Json;

use Json\Exceptions\InvalidLinkException;
use Json\Document\Links;
use Json\Document\Meta;
use Json\Document\Data;
use Json\Document\Relationships;
use Json\Document\Error\Source;

/**
 * Class Factory
 * @package Json
 */
class Factory implements IFactory
{

    /**
     * @param string $name
     * @param string $href
     * @param Document\Meta\Collection $meta
     * @throws InvalidLinkException
     * @return Links
     */
    public function createLinks($name, $href, Document\Meta\Collection $meta = null)
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
     * @param string $name
     * @param array $relationships
     * @return Relationships\Collection
     */
    public function createRelationshipsCollection($name, array $relationships)
    {
        return new Relationships\Collection($relationships);
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

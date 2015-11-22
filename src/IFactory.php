<?php

namespace Json;

use Json\Exceptions\InvalidLinkException;
use Json\Object\Data;
use Json\Object\Links;
use Json\Object\Meta;
use Json\Object\Relationships;
use Json\Object\Error\Source;

/**
 * Interface IFactory
 * @package Json
 */
interface IFactory
{

    /**
     * @param string $name
     * @param string $href
     * @param Object\Meta\Collection $meta
     * @throws InvalidLinkException
     * @return Links
     */
    public function createLinks($name, $href, Object\Meta\Collection $meta = null);

    /**
     * @param string $name
     * @param string|array $value
     * @return Meta
     */
    public function createMeta($name, $value);

    /**
     * @param string $name
     * @param Links\Collection|null $linksCollection
     * @param Object\Data\Collection|null $dataCollection
     * @param Meta\Collection|null $metaCollection
     * @return Relationships
     */
    public function createRelationships(
        $name,
        Links\Collection $linksCollection = null,
        Object\Data\Collection $dataCollection = null,
        Meta\Collection $metaCollection = null
    );

    /**
     * @param string $pointer
     * @param string $parameters
     * @return Source
     */
    public function createSource($pointer, $parameters);

    /**
     * @param Data[] $data
     * @return Object\Data\Collection
     */
    public function createDataCollection(array $data);

    /**
     * @param Links[] $links
     * @return Links\Collection
     */
    public function createLinksCollection(array $links);

    /**
     * @param Meta[] $metaArray
     * @return Meta\Collection
     */
    public function createMetaCollection(array $metaArray);
}

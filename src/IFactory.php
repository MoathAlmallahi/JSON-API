<?php

namespace Json;

use Json\Exceptions\InvalidLinkException;
use Json\Document\Data;
use Json\Document\Links;
use Json\Document\Meta;
use Json\Document\Relationships;
use Json\Document\Error\Source;

/**
 * Interface IFactory
 * @package Json
 */
interface IFactory
{

    /**
     * @param string $name
     * @param string $href
     * @param Document\Meta\Collection $meta
     * @throws InvalidLinkException
     * @return Links
     */
    public function createLinks($name, $href, Document\Meta\Collection $meta = null);

    /**
     * @param string $name
     * @param string|array $value
     * @return Meta
     */
    public function createMeta($name, $value);

    /**
     * @param string $name
     * @param Links\Collection|null $linksCollection
     * @param Document\Data\Collection|null $dataCollection
     * @param Meta\Collection|null $metaCollection
     * @return Relationships
     */
    public function createRelationships(
        $name,
        Links\Collection $linksCollection = null,
        Document\Data\Collection $dataCollection = null,
        Meta\Collection $metaCollection = null
    );

    /**
     * @param string $name
     * @param array $relationships
     * @return Relationships\Collection
     */
    public function createRelationshipsCollection(
        $name,
        array $relationships
    );

    /**
     * @param string $pointer
     * @param string $parameters
     * @return Source
     */
    public function createSource($pointer, $parameters);

    /**
     * @param Data[] $data
     * @return Document\Data\Collection
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

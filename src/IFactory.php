<?php

namespace Json;

use Json\Document\Error;
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
     * @param string|null $type
     * @param mixed $id
     * @param array $attributes
     * @param \Json\Document\Relationships\Collection $relationships
     * @param \Json\Document\Links\Collection $links
     * @param \Json\Document\Meta\Collection $meta
     */
    public function createData(
        $type = null,
        $id = null,
        array $attributes = null,
        Relationships\Collection $relationships = null,
        Links\Collection $links = null,
        Meta\Collection $meta = null);

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
     * @param array $relationships
     * @return Relationships\Collection
     */
    public function createRelationshipsCollection(
        array $relationships
    );

    /**
     * @param array $errors
     * @return Document\Error\Collection
     */
    public function createErrorsCollection(array $errors);

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

    /**
     * @param Data\Collection|null $dataCollection
     * @param Document\Error\Collection|null $errorsCollection
     * @param Meta\Collection|null $metaCollection
     * @param Links\Collection|null $linksCollection
     * @param Document\Included\Collection|null $includedCollection
     * @return Document
     */
    public function createDocument(
        Document\Data\Collection $dataCollection = null,
        Document\Error\Collection $errorsCollection = null,
        Document\Meta\Collection $metaCollection = null,
        Document\Links\Collection $linksCollection = null,
        Document\Included\Collection $includedCollection = null
    );

    /**
     * @param null|int $id
     * @param null|int $status
     * @param null|int $code
     * @param null|string $title
     * @param null|string $detail
     * @param Source|null $source
     * @param Links\Collection|null $links
     * @param Meta\Collection|null $meta
     * @return Error
     */
    public function createError(
        $id = null,
        $status = null,
        $code = null,
        $title = null,
        $detail = null,
        Source $source = null,
        Document\Links\Collection $links = null,
        Document\Meta\Collection $meta = null
    );
}

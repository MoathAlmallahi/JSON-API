<?php

namespace Json;

use Json\Document\Error;
use Json\Document\Included;
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
     * @param array $relationships
     * @return Relationships\Collection
     */
    public function createRelationshipsCollection(array $relationships)
    {
        if (null !== $relationships && !empty($relationships)) {
            return new Relationships\Collection($relationships);
        }

        return null;
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
        if (null !== $data && !empty($data)) {
            return new Data\Collection($data);
        }

        return null;
    }

    /**
     * @param Links[] $links
     * @return Links\Collection
     */
    public function createLinksCollection(array $links)
    {
        if (null !== $links && !empty($links)) {
            return new Links\Collection($links);
        }

        return null;
    }

    /**
     * @param Meta[] $metaArray
     * @return Meta\Collection
     */
    public function createMetaCollection(array $metaArray)
    {
        if (null !== $metaArray && !empty($metaArray)) {
            return new Meta\Collection($metaArray);
        }

        return null;
    }

    /**
     * @param string $type
     * @param mixed $id
     * @param array $attributes
     * @param \Json\Document\Relationships\Collection $relationships
     * @param \Json\Document\Links\Collection $links
     * @param \Json\Document\Meta\Collection $meta
     * @return Data
     */
    public function createData(
        $type = null,
        $id = null,
        array $attributes = null,
        Document\Relationships\Collection $relationships = null,
        Document\Links\Collection $links = null,
        Document\Meta\Collection $meta = null
    ) {
        return new Data($type, $id, $attributes, $relationships, $links, $meta);
    }

    /**
     * @param array $errors
     * @return Document\Error\Collection
     */
    public function createErrorsCollection(
        array $errors
    ) {
        if (null !== $errors && !empty($errors)) {
            return new Document\Error\Collection($errors);
        }

        return null;
    }

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
    ) {
        return new Document(
            $dataCollection,
            $errorsCollection,
            $metaCollection,
            $linksCollection,
            $includedCollection
        );
    }

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
    ) {
        return new Error($id, $status, $code, $title, $detail, $source, $links, $meta);
    }

    /**
     * @param Included[] $included
     * @return Included\Collection
     */
    public function createIncludedCollection(array $included)
    {
        return new Included\Collection($included);
    }

    /**
     * @param string|null $type
     * @param string|int|null $id
     * @param array|null $attributes
     * @param Relationships\Collection|null $relationships
     * @param Links\Collection|null $links
     * @param Meta\Collection|null $meta
     * @return Included
     */
    public function createIncluded(
        $type = null,
        $id = null,
        array $attributes = null,
        Relationships\Collection $relationships = null,
        Links\Collection $links = null,
        Meta\Collection $meta = null
    ) {
        return new Included($type, $id, $attributes, $relationships, $links, $meta);
    }
}

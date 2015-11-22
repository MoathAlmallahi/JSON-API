<?php

namespace Json;

use Json\Exceptions\InvalidJsonApiDocumentException;

/**
 * Class Document
 * @package Json
 */
class Document implements IRecursively
{

    const FIELD_DATA = 'data';
    const FIELD_ERRORS = 'errors';
    const FIELD_META = 'meta';
    const FIELD_LINKS = 'links';
    const FIELD_INCLUDED = 'included';

    /**
     * @var Object\Data\Collection
     */
    private $dataCollection;

    /**
     * @var Object\Error\Collection
     */
    private $errorCollection;

    /**
     * @var Object\Meta\Collection
     */
    private $metaCollection;

    /**
     * @var Object\Links\Collection
     */
    private $linksCollection;

    /**
     * @var Object\Included\Collection
     */
    private $includedCollection;

    /**
     * constructor
     * @param Object\Data\Collection|null $dataCollection
     * @param Object\Error\Collection|null $errorCollection
     * @param Object\Meta\Collection|null $metaCollection
     * @param Object\Links\Collection|null $linksCollection
     * @param Object\Included\Collection|null $includedCollection
     * @throws InvalidJsonApiDocumentException
     */
    public function __construct(
        Object\Data\Collection $dataCollection = null,
        Object\Error\Collection $errorCollection = null,
        Object\Meta\Collection $metaCollection = null,
        Object\Links\Collection $linksCollection = null,
        Object\Included\Collection $includedCollection = null
    ) {
        if (
            null === $dataCollection && null === $errorCollection && null === $metaCollection
        ) {
            throw new InvalidJsonApiDocumentException;
        }

        $this->dataCollection = $dataCollection;
        $this->errorCollection = $errorCollection;
        $this->metaCollection = $metaCollection;
        $this->linksCollection = $linksCollection;
        $this->includedCollection = $includedCollection;
    }

    /**
     * @return Object\Data\Collection
     */
    public function getDataCollection()
    {
        return $this->dataCollection;
    }

    /**
     * @return Object\Error\Collection
     */
    public function getErrorCollection()
    {
        return $this->errorCollection;
    }

    /**
     * @return Object\Meta\Collection
     */
    public function getMetaCollection()
    {
        return $this->metaCollection;
    }

    /**
     * @return Object\Links\Collection
     */
    public function getLinksCollection()
    {
        return $this->linksCollection;
    }

    /**
     * @return Object\Included\Collection
     */
    public function getIncludedCollection()
    {
        return $this->includedCollection;
    }

    /**
     * Returns json encoded value or null
     * @return string|null
     */
    public function getAsJson()
    {
        return json_encode($this->getAsArray());
    }

    /**
     * Returns the json as array
     * @return array
     */
    public function getAsArray()
    {
        $document = [
            static::FIELD_DATA => $this->getDataCollection()->getAsArray(),
            static::FIELD_ERRORS => $this->getErrorCollection()->getAsArray(),
            static::FIELD_META => $this->getMetaCollection()->getAsArray(),
            static::FIELD_LINKS => $this->getLinksCollection()->getAsArray(),
            static::FIELD_INCLUDED => $this->getIncludedCollection()->getAsArray()
        ];

        return array_filter($document);
    }
}

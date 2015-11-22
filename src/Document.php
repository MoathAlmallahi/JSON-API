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
     * @var Document\Data\Collection
     */
    private $dataCollection;

    /**
     * @var Document\Error\Collection
     */
    private $errorCollection;

    /**
     * @var Document\Meta\Collection
     */
    private $metaCollection;

    /**
     * @var Document\Links\Collection
     */
    private $linksCollection;

    /**
     * @var Document\Included\Collection
     */
    private $includedCollection;

    /**
     * constructor
     * @param Document\Data\Collection|null $dataCollection
     * @param Document\Error\Collection|null $errorCollection
     * @param Document\Meta\Collection|null $metaCollection
     * @param Document\Links\Collection|null $linksCollection
     * @param Document\Included\Collection|null $includedCollection
     * @throws InvalidJsonApiDocumentException
     */
    public function __construct(
        Document\Data\Collection $dataCollection = null,
        Document\Error\Collection $errorCollection = null,
        Document\Meta\Collection $metaCollection = null,
        Document\Links\Collection $linksCollection = null,
        Document\Included\Collection $includedCollection = null
    ) {
        if (
            (null === $dataCollection && null === $errorCollection && null === $metaCollection) ||
            (null !== $dataCollection && null !== $errorCollection)
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
     * @return Document\Data\Collection
     */
    public function getDataCollection()
    {
        return $this->dataCollection;
    }

    /**
     * @return Document\Error\Collection
     */
    public function getErrorCollection()
    {
        return $this->errorCollection;
    }

    /**
     * @return Document\Meta\Collection
     */
    public function getMetaCollection()
    {
        return $this->metaCollection;
    }

    /**
     * @return Document\Links\Collection
     */
    public function getLinksCollection()
    {
        return $this->linksCollection;
    }

    /**
     * @return Document\Included\Collection
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

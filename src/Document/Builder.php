<?php

namespace Json\Document;

use Json\Document;
use Json\IFactory;
use Json\IRecursively;

/**
 * Class Builder
 * @package Json\Document
 */
class Builder implements IBuilder
{
    /**
     * @var IFactory
     */
    private $factory;

    /**
     * @var array
     */
    private $document = [
        Document::FIELD_DATA => null,
        Document::FIELD_ERRORS => null,
        Document::FIELD_INCLUDED => null,
        Document::FIELD_LINKS => null,
        Document::FIELD_META => null
    ];

    /**
     * @param IFactory $factory
     * @param IBuilder $builder
     */
    public function __construct(IFactory $factory, IBuilder $builder = null)
    {
        $this->factory = $factory;
    }

    /**
     * @return Data\Builder
     */
    public function getDataCollectionBuilder()
    {
        return new Data\Builder($this->factory, $this);
    }

    /**
     * @param Data\Collection $data
     * @return Builder
     */
    public function setDataCollection(Data\Collection $data)
    {
        $this->document[Document::FIELD_DATA] = $data;

        return $this;
    }

    /**
     * @return Error\Builder
     */
    public function getErrorsCollectionBuilder()
    {
        return new Error\Builder($this->factory, $this);
    }

    /**
     * @param Error\Collection $errorsCollection
     * @return Builder
     */
    public function setErrorsCollection(Error\Collection $errorsCollection)
    {
        $this->document[Document::FIELD_ERRORS] = $errorsCollection;

        return $this;
    }

    /**
     * @return Meta\Builder
     */
    public function getMetaCollectionBuilder()
    {
        return new Meta\Builder($this->factory, $this);
    }

    /**
     * @param Meta\Collection $metaCollection
     * @return Builder
     */
    public function setMetaCollection(Meta\Collection $metaCollection)
    {
        $this->document[Document::FIELD_META] = $metaCollection;

        return $this;
    }

    /**
     * @param Links\Collection $linksCollection
     * @return Builder
     */
    public function setLinksCollection(Links\Collection $linksCollection)
    {
        $this->document[Document::FIELD_LINKS] = $linksCollection;

        return $this;
    }

    /**
     * @return Links\Builder
     */
    public function getLinksCollectionBuilder()
    {
        return new Links\Builder($this->factory, $this);
    }

    /**
     * @param Included\Collection $includedCollection
     * @return Builder
     */
    public function setIncludedCollection(Included\Collection $includedCollection)
    {
        $this->document[Document::FIELD_INCLUDED] = $includedCollection;

        return $this;
    }

    /**
     *
     * @return Included\Builder
     */
    public function getIncludedCollectionBuilder()
    {
        return new Included\Builder($this->factory, $this);
    }

    /**
     * @return Document
     */
    public function getDocument()
    {
        return $this->factory->createDocument(
            $this->document[Document::FIELD_DATA],
            $this->document[Document::FIELD_ERRORS],
            $this->document[Document::FIELD_META],
            $this->document[Document::FIELD_LINKS],
            $this->document[Document::FIELD_INCLUDED]
        );
    }

    public function addToParent()
    {
        return;
    }
}
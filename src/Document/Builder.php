<?php

namespace Json\Document;

use Json\Document;
use Json\IFactory;
use Json\IRecursively;

/**
 * Class Builder
 * @package Json\Document
 */
class Builder
{

    /**
     * @var IFactory
     */
    private $factory;

    /**
     * @var IBuilder
     */
    private $builder;

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
        $this->builder = $builder;
    }

    /**
     * @return Data\Builder
     */
    public function getDataBuilder()
    {
        return new Data\Builder($this->factory, $this);
    }

    /**
     * @param IRecursively $data
     * @return Builder
     */
    public function addData(IRecursively $data)
    {
        $this->document[Document::FIELD_DATA][] = $data;

        return $this;
    }

    /**
     * @param IRecursively $errors
     * @return Builder
     */
    public function addErrors(IRecursively $errors)
    {
        $this->document[Document::FIELD_ERRORS][] = $errors;

        return $this;
    }

    /**
     * @param IRecursively $meta
     * @return Builder
     */
    public function addMeta(IRecursively $meta)
    {
        $this->document[Document::FIELD_META][] = $meta;

        return $this;
    }

    /**
     * @param IRecursively $links
     * @return Builder
     */
    public function addLinks(IRecursively $links)
    {
        $this->document[Document::FIELD_LINKS][] = $links;

        return $this;
    }

    /**
     * @param IRecursively $included
     * @return Builder
     */
    public function addIncluded(IRecursively $included)
    {
        $this->document[Document::FIELD_INCLUDED][] = $included;

        return $this;
    }

    /**
     * @return Document
     */
    public function getDocument()
    {
        return new Document(
            new Data\Collection($this->document[Document::FIELD_DATA]),
            new Error\Collection($this->document[Document::FIELD_ERRORS]),
            new Meta\Collection($this->document[Document::FIELD_META]),
            new Links\Collection($this->document[Document::FIELD_LINKS]),
            new Included\Collection($this->document[Document::FIELD_INCLUDED])
        );
    }
}

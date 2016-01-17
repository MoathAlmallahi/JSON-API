<?php

namespace Json\Document\Links;

use Json\Document;
use Json\Exceptions\InvalidDocumentLevelWrite;
use Json\IFactory;

/**
 * Class Builder
 * @package Json\Document\Links
 */
class Builder implements Document\IBuilder
{
    /**
     * @var IFactory
     */
    private $factory;

    /**
     * @var Document\Data\Builder|Document\Error\Builder|Document\Relationships\Builder
     */
    private $builder;

    /**
     * @var Document\Links[]
     */
    private $links;

    /**
     * @var array
     */
    private $structure;

    /**
     * @param IFactory $factory
     * @param Document\IBuilder|null $builder
     */
    public function __construct(IFactory $factory, Document\IBuilder $builder = null)
    {
        $this->factory = $factory;
        $this->builder = $builder;
        $this->resetStructure();
    }

    /**
     * @return Builder
     */
    public function addLink()
    {
        $this->links[$this->structure[Document\Links::FIELD_NAME]] = $this->factory->createLinks(
            $this->structure[Document\Links::FIELD_NAME],
            $this->structure[Document\Links::FIELD_HREF],
            $this->structure[Document\Links::FIELD_META]
        );
        $this->resetStructure();

        return $this;
    }

    /**
     * @param string $name
     * @return Builder
     */
    public function setName($name)
    {
        $this->structure[Document\Links::FIELD_NAME] = $name;

        return $this;
    }

    /**
     * @param $href
     * @return Builder
     */
    public function setHref($href)
    {
        $this->structure[Document\Links::FIELD_HREF] = $href;

        return $this;
    }

    /**
     * @param Document\Meta\Collection $meta
     * @return Builder
     */
    public function setMetaCollection(Document\Meta\Collection $meta)
    {
        $this->structure[Document\Links::FIELD_META] = $meta;

        return $this;
    }

    /**
     * @return Document\Meta\Builder
     */
    public function getMetaCollectionBuilder()
    {
        return new Document\Meta\Builder($this->factory, $this);
    }

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @return Document\IBuilder
     * @throws InvalidDocumentLevelWrite
     */
    public function addToParent()
    {
        if (null === $this->builder) {
            throw new InvalidDocumentLevelWrite;
        }

        $this->builder->setLinksCollection(
            $this->factory->createLinksCollection($this->links)
        );
        $this->resetStructure();

        return $this->builder;
    }

    /**
     * @return void
     */
    private function resetStructure()
    {
        $this->structure = [
            Document\Links::FIELD_NAME => null,
            Document\Links::FIELD_HREF => null,
            Document\Links::FIELD_META => null
        ];
    }
}

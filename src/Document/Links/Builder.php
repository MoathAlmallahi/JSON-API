<?php

namespace Json\Document\Links;

use Json\Document\IBuilder;
use Json\Document\Links;
use Json\Document\Meta;
use Json\Exceptions\InvalidDocumentLevelWrite;
use Json\IFactory;

/**
 * Class Builder
 * @package Json\Document\Links
 */
class Builder implements IBuilder
{

    /**
     * @var IFactory
     */
    private $factory;

    /**
     * @var \Json\Document\Data\Builder
     */
    private $builder;

    /**
     * @var Links[]
     */
    private $links;

    /**
     * @param IFactory $factory
     * @param IBuilder|null $builder
     */
    public function __construct(IFactory $factory, IBuilder $builder = null)
    {
        $this->factory = $factory;
        $this->builder = $builder;
    }

    /**
     * @param string $name
     * @param string $href
     * @param Meta\Collection $metaCollection
     */
    public function addLinks($name, $href = null, Meta\Collection $metaCollection)
    {
        $this->links[] = $this->factory->createLinks($name, $href, $metaCollection);
    }

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @return IBuilder
     * @throws InvalidDocumentLevelWrite
     */
    public function addToParent()
    {
        if (null === $this->builder)
            throw new InvalidDocumentLevelWrite;
        $this->builder->addLinks(
            $this->factory->createLinksCollection($this->links)
        );

        return $this->builder;
    }
}
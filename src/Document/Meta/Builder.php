<?php

namespace Json\Document\Meta;

use Json\Document\IBuilder;
use Json\Document\Meta;
use Json\Exceptions\InvalidDocumentLevelWrite;
use Json\IFactory;

/**
 * Class Builder
 * @package Json\Document\Meta
 */
class Builder implements IBuilder
{

    /**
     * @var IFactory
     */
    private $factory;

    /**
     * @var \Json\Document\Data\Builder|\Json\Document\Links\Builder|null
     */
    private $builder;

    /**
     * @var array
     */
    private $meta = [];

    /**
     * @param IFactory $factory
     * @param \Json\Document\Data\Builder|\Json\Document\Links\Builder|null|IBuilder|null $builder
     */
    public function __construct(IFactory $factory, IBuilder $builder = null)
    {
        $this->factory = $factory;
        $this->builder = $builder;
    }

    /**
     * @param string $name
     * @param string|array $value
     */
    public function addMeta($name, $value)
    {
        $this->meta[$name] = new Meta($name, $value);
    }

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @throws InvalidDocumentLevelWrite
     * @return IBuilder
     */
    public function addToParent()
    {
        if (null === $this->builder) {
            throw new InvalidDocumentLevelWrite;
        }

        $this->builder->addMetaCollection(
            $this->factory->createMetaCollection($this->meta)
        );
    }
}
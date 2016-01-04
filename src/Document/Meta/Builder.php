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
     * @var array
     */
    private $structure;

    /**
     * @param IFactory $factory
     * @param \Json\Document\Data\Builder|\Json\Document\Links\Builder|null|IBuilder|null $builder
     */
    public function __construct(IFactory $factory, IBuilder $builder = null)
    {
        $this->factory = $factory;
        $this->builder = $builder;
        $this->resetStructure();
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->structure['name'] = $name;

        return $this;
    }

    /**
     * @param mixed $value
     * @return Builder
     */
    public function setValue($value)
    {
        $this->structure['value'] = $value;

        return $this;
    }

    /**
     * @return Builder
     */
    public function addMeta()
    {
        $this->meta[] = $this->factory->createMeta(
            $this->structure['name'],
            $this->structure['value']
        );
        $this->resetStructure();

        return $this;
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

        $this->builder->setMetaCollection(
            $this->factory->createMetaCollection($this->meta)
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
            'name' => null,
            'value' => null
        ];
    }
}
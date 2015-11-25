<?php

namespace Json\Document\Error;

use Json\Document\IBuilder;
use Json\Document;
use Json\Exceptions\InvalidDocumentLevelWrite;
use Json\IFactory;

/**
 * Class Builder
 * @package Json\Document\Error
 */
class Builder implements IBuilder
{

    /**
     * @var IFactory
     */
    private $factory;

    /**
     * @var IBuilder|Document\Builder
     */
    private $builder;

    /**
     * @var array
     */
    private $errors;

    /**
     * @param IFactory $factory
     * @param Document\Builder|IBuilder|null $builder
     */
    public function __construct(IFactory $factory, IBuilder $builder = null)
    {
        $this->factory = $factory;
        $this->builder = $builder;
    }

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @throws InvalidDocumentLevelWrite
     * @return IBuilder
     */
    public function addToParent()
    {
        $this->builder->addErrorsCollection();
    }
}
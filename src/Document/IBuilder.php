<?php

namespace Json\Document;

use Json\Exceptions\InvalidDocumentLevelWrite;
use Json\IFactory;

/**
 * Interface IBuilder
 * @package Json\Document
 */
interface IBuilder
{

    /**
     * @param IFactory $factory
     * @param IBuilder|null $builder
     */
    public function __construct(IFactory $factory, IBuilder $builder = null);

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @throws InvalidDocumentLevelWrite
     * @return IBuilder
     */
    public function addToParent();
}
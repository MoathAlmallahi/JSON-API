<?php

namespace Json\Document\Error;

use Json\Document\Error;
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
     * @var Error[]
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
     * @param null|int $id
     * @param null|int $status
     * @param null|int $code
     * @param null|string $title
     * @param null|string $detail
     * @param Source|null $source
     * @param Document\Links\Collection|null $links
     * @param Document\Meta\Collection|null $meta
     * @return Error
     */
    public function addError(
        $id = null,
        $status = null,
        $code = null,
        $title = null,
        $detail = null,
        Source $source = null,
        Document\Links\Collection $links = null,
        Document\Meta\Collection $meta = null
    ) {
        $this->errors[] = $this->factory->createError($id, $status, $code, $title, $detail, $source, $links, $meta);
    }

    /**
     * Adds the built object to the parent if there is any, and return the parent
     * @throws InvalidDocumentLevelWrite
     * @return IBuilder
     */
    public function addToParent()
    {
        $this->builder->addErrorsCollection(
            $this->factory->createErrorsCollection($this->errors)
        );
    }
}

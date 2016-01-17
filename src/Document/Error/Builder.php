<?php

namespace Json\Document\Error;

use Json\Document\Error;
use Json\Document\IBuilder;
use Json\Document;
use Json\Document\Links;
use Json\Document\Meta;
use Json\Exceptions\InvalidDocumentLevelWrite;
use Json\IFactory;

/**
 * Class Builder
 * @package Json\Document\Error
 */
class Builder implements Document\Builder\LinksInterface, Document\Builder\MetaInterface
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
    private $errorsCollection;

    /**
     * @var array
     */
    private $structure;

    /**
     * @param IFactory $factory
     * @param Document\Builder|IBuilder|null $builder
     */
    public function __construct(IFactory $factory, IBuilder $builder = null)
    {
        $this->factory = $factory;
        $this->builder = $builder;
        $this->resetStructure();
    }

    /**
     * @param int|string $id
     * @return Builder
     */
    public function setId($id)
    {
        $this->structure[Error::FIELD_ID] = $id;

        return $this;
    }

    /**
     * @param int|string $status
     * @return Builder
     */
    public function setStatus($status)
    {
        $this->structure[Error::FIELD_STATUS] = $status;

        return $this;
    }

    /**
     * @param string $code
     * @return Builder
     */
    public function setCode($code)
    {
        $this->structure[Error::FIELD_CODE] = $code;

        return $this;
    }

    /**
     * @param string $title
     * @return Builder
     */
    public function setTitle($title)
    {
        $this->structure[Error::FIELD_TITLE] = $title;

        return $this;
    }

    /**
     * @param string $detail
     * @return Builder
     */
    public function setDetail($detail)
    {
        $this->structure[Error::FIELD_DETAIL] = $detail;

        return $this;
    }

    /**
     * @param string $pointer
     * @param string $parameters
     * @return Builder
     */
    public function setSource($pointer, $parameters)
    {
        $this->structure[Error::FIELD_SOURCE] = $this->factory->createSource($pointer, $parameters);

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
     * @param Links\Collection $linksCollection
     * @return static
     */
    public function setLinksCollection(Links\Collection $linksCollection)
    {
        $this->structure[Error::FIELD_LINKS] = $linksCollection;
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
     * @return static
     */
    public function setMetaCollection(Meta\Collection $metaCollection)
    {
        $this->structure[Error::FIELD_META] = $metaCollection;

        return $this;
    }

    /**
     * @return Builder
     */
    public function addError()
    {
        $this->errorsCollection[] = $this->factory->createError(
            $this->structure[Error::FIELD_ID],
            $this->structure[Error::FIELD_STATUS],
            $this->structure[Error::FIELD_CODE],
            $this->structure[Error::FIELD_TITLE],
            $this->structure[Error::FIELD_DETAIL],
            $this->structure[Error::FIELD_SOURCE],
            $this->structure[Error::FIELD_LINKS],
            $this->structure[Error::FIELD_META]
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
        $this->builder->addErrorsCollection(
            $this->factory->createErrorsCollection($this->errorsCollection)
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
            Error::FIELD_ID => null,
            Error::FIELD_STATUS => null,
            Error::FIELD_CODE => null,
            Error::FIELD_TITLE => null,
            Error::FIELD_DETAIL => null,
            Error::FIELD_SOURCE => null,
            Error::FIELD_LINKS => null,
            Error::FIELD_META => null
        ];
    }
}

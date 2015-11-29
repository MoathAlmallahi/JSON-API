<?php

namespace Json\Document;

use Json\Exceptions\InvalidErrorException;
use Json\IRecursively;
use Json\Document\Error\Source;
use Json\Document\Links\Collection as LinksCollection;
use Json\Document\Meta\Collection as MetaCollections;

/**
 * Class Error
 * @package Json\Document
 */
class Error implements IRecursively
{

    const FIELD_ID = 'id';
    const FIELD_LINKS = 'links';
    const FIELD_STATUS = 'status';
    const FIELD_CODE = 'code';
    const FIELD_TITLE = 'title';
    const FIELD_DETAIL = 'detail';
    const FIELD_SOURCE = 'source';
    const FIELD_META = 'meta';
    /**
     * @var mixed
     */
    private $id;

    /**
     * @var LinksCollection|null
     */
    private $links;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $detail;

    /**
     * @var Error\Source|null
     */
    private $source;

    /**
     * @var MetaCollections|null
     */
    private $meta;

    /**
     * Error constructor.
     * @param mixed $id A unique identifier for this particular occurrence of the problem
     * @param int $status The HTTP status code applicable to this problem, expressed as a string value
     * @param int $code An application-specific error code, expressed as a string value
     * @param string $title A short, human-readable summary of the problem that
     * SHOULD NOT change from occurrence to occurrence of the problem, except for purposes of localization.
     * @param string $detail A human-readable explanation specific to this occurrence of the problem.
     * @param null|Source $source an Document containing references to the source of the error, optionally including any of the following members
     * @param null|LinksCollection $links A links Document
     * @param null|MetaCollections $meta A meta Document containing non-standard meta-information about the error
     * @throws InvalidErrorException
     */
    public function __construct(
        $id = null,
        $status = null,
        $code = null,
        $title = null,
        $detail = null,
        Source $source = null,
        LinksCollection $links = null,
        MetaCollections $meta = null
    ) {
        if (
            null === $id && null === $status &&
            null === $code && null === $title &&
            null === $detail && null === $source &&
            null === $links && null === $meta
        ) {
            throw new InvalidErrorException;
        }

        $this->id = $id;
        $this->links = $links;
        $this->status = $status;
        $this->code = $code;
        $this->title = $title;
        $this->detail = $detail;
        $this->source = $source;
        $this->meta = $meta;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return LinksCollection|null
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @return Source|null
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return MetaCollections|null
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Returns json encoded value or null
     * @return string|null
     */
    public function getAsJson()
    {
        return json_encode($this->getAsArray());
    }

    /**
     * Returns the json as array
     * @return array
     */
    public function getAsArray()
    {
        $error = [
            static::FIELD_ID => $this->getId(),
            static::FIELD_LINKS => $this->getLinks()->getAsArray(),
            static::FIELD_STATUS => $this->getStatus(),
            static::FIELD_CODE => $this->getCode(),
            static::FIELD_TITLE => $this->getTitle(),
            static::FIELD_DETAIL => $this->getDetail(),
            static::FIELD_SOURCE => $this->getSource()->getAsArray(),
            static::FIELD_META => $this->getMeta()->getAsArray()
        ];

        return [array_filter($error)];
    }
}

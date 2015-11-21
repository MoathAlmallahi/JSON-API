<?php

namespace Json;

use Json\Object\Links\Collection as LinksCollection;
use Json\Object\Meta\Collection as MetaCollections;
use Json\Object\Source;

/**
 * Class Error
 * @package Json\Object
 */
class Error implements IIRecursively
{

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
     * @var Source|null
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
     * @param null|Source $source an object containing references to the source of the error, optionally including any of the following members
     * @param null|LinksCollection $links A links object
     * @param null|MetaCollections $meta A meta object containing non-standard meta-information about the error
     */
    public function __construct(
        $id,
        $status,
        $code,
        $title,
        $detail,
        Source $source = null,
        LinksCollection $links = null,
        MetaCollections $meta = null
    ) {
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
     * Returns json encoded value or null
     * @return string|null
     */
    public function getAsJson()
    {
        // TODO: Implement getAsJson() method.
    }
}

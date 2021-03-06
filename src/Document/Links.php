<?php

namespace Json\Document;

use Json\Exceptions\InvalidLinkException;
use Json\IRecursively;

/**
 * Class Links
 * @package Json\Document
 */
class Links implements IRecursively
{
    const FIELD_NAME = 'name';
    const FIELD_META = 'meta';
    const FIELD_HREF = 'href';

    /**
     * @var string
     */
    private $name;

    /**
     * @var null|string
     */
    private $href;

    /**
     * @var Meta\Collection|null
     */
    private $metaCollection;

    /**
     * Initialize and inject the link Document with the specified data
     * @param string $name
     * @param string $href a string containing the link's URL
     * @param Meta\Collection|null $metaCollection a meta object containing non-standard meta-information about the link
     * @throws InvalidLinkException
     */
    public function __construct($name, $href = null, Meta\Collection $metaCollection = null)
    {
        if ((!isset($href) && !isset($metaCollection)) || !is_string($name)) {
            throw new InvalidLinkException;
        }

        $this->name = $name;
        $this->href = $href;
        $this->metaCollection = $metaCollection;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @return Meta\Collection|null
     */
    public function getMeta()
    {
        return $this->metaCollection;
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
        if (null === $this->getMeta()) {
            return [$this->getName() => $this->getHref()];
        } elseif (null === $this->getHref()) {
            return [
                $this->getName() => [
                    static::FIELD_META => $this->getMeta()->getAsArray()
                ]
            ];
        } else {
            return [
                $this->getName() => [
                    static::FIELD_HREF => $this->getHref(),
                    static::FIELD_META => $this->getMeta()->getAsArray()
                ]
            ];
        }
    }
}

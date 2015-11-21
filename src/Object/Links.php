<?php

namespace Json\Object;

use Json\Exceptions\InvalidLinkException;
use Json\IRecursively;

/**
 * Class Links
 * @package Json\Object
 */
class Links implements IRecursively
{

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
    private $meta;

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
        return $this->meta;
    }

    /**
     * Initialize and inject the link object with the specified data
     * @param string $name
     * @param string $href
     * @param Meta\Collection|null $meta
     * @throws InvalidLinkException
     */
    public function __construct($name, $href = null, Meta\Collection $meta = null)
    {
        if (!isset($href) && !isset($meta)) {
            throw new InvalidLinkException;
        }
        $this->name = $name;
        $this->href = $href;
        $this->meta = $meta;
    }

    /**
     * Converts the link object to an array
     * @return array
     */
    public function toArray()
    {
        if (null === $this->meta) {
            return [
                $this->getName() => $this->getHref()
            ];
        }
        return [
            $this->getName() => [
                static::FIELD_HREF => $this->getHref(),
                static::FIELD_META => $this->getMeta()
            ]
        ];
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
            return [
                $this->getName() => $this->getHref()
            ];
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

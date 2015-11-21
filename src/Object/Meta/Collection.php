<?php

namespace Json\Object\Meta;

use Json\Exceptions\InvalidCollectionItemTypeException;
use Json\Object\Meta;
use Json\IRecursively;

/**
 * Class Collection
 * @package Json\Object\Meta
 */
class Collection implements \Iterator, \Countable, IRecursively
{

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var array
     */
    private $positions = [];

    /**
     * @var Meta[]
     */
    private $meta;

    /**
     * @param Meta[] $meta
     */
    public function __construct(array $meta)
    {
        $this->meta = $meta;
        $this->positions = array_keys($this->meta);
    }

    /**
     * @return Meta
     */
    public function current()
    {
        return $this->meta[$this->positions[$this->position]];
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return $this->positions[$this->position];
    }

    /**
     * @inheritdoc
     */
    public function valid()
    {
        return isset($this->positions[$this->position]);
    }

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->meta);
    }

    /**
     * Returns json encoded value or null
     * @return string|null
     */
    public function getAsJson()
    {
        return json_encode(
            $this->getAsArray()
        );
    }

    /**
     * Returns the json as array
     * @return array
     */
    public function getAsArray()
    {
        return array_map(function ($meta) {
            /** @var Meta $meta */
            return $meta->getAsArray();
        }, $this->meta);
    }

    /**
     * @param Meta $element
     * @throws InvalidCollectionItemTypeException
     */
    public function validateType($element)
    {
        if (!$element instanceof Meta) {
            throw new InvalidCollectionItemTypeException;
        }
    }
}

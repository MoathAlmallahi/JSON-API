<?php

namespace Json\Object\Links;

use Json\Exceptions\InvalidCollectionItemTypeException;
use Json\IRecursively;
use Json\Object\Links;

/**
 * Class Collection
 * @package Json\Object\Links
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
     * @var Links[]
     */
    private $links;

    /**
     * @param Links[] $links
     */
    public function __construct(array $links)
    {
        $this->links = $links;
        $this->positions = array_keys($this->links);
    }

    /**
     * @return Links
     */
    public function current()
    {
        return $this->links[$this->positions[$this->position]];
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
        return count($this->links);
    }

    /**
     * @param Links $element
     * @throws InvalidCollectionItemTypeException
     */
    public function validateType($element)
    {
        if (!$element instanceof Links) {
            throw new InvalidCollectionItemTypeException;
        }
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
        return array_map(function ($links) {
            /** @var Links $links */
            return $links->getAsArray();
        }, $this->links);
    }
}

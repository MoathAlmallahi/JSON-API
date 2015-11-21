<?php

namespace Json\Object\Relationships;

use Json\IRecursively;
use Json\Object\Relationships;

/**
 * Class Collection
 * @package Json\Object\Relationships
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
     * @var Relationships[]
     */
    private $relationships;

    /**
     * @param Relationships[] $relationships
     */
    public function __construct(array $relationships)
    {
        $this->relationships = $relationships;
        $this->positions = array_keys($this->relationships);
    }

    /**
     * @return Relationships
     */
    public function current()
    {
        return $this->relationships[$this->positions[$this->position]];
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
        return count($this->relationships);
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
        return array_map(function ($relationships) {
            /** @var Relationships $relationships */
            return $relationships->getAsArray();
        }, $this->relationships);
    }
}

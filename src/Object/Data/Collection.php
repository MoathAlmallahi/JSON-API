<?php

namespace Json\Object\Data;

use Json\Data;
use Json\Exceptions\InvalidCollectionItemTypeException;
use Json\IRecursively;

/**
 * Class Collection
 * @package Json\Object\Data
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
     * @var Data[]
     */
    private $data;

    /**
     * @param Data[] $data
     */
    public function __construct(array $data)
    {
        array_filter($data, [$this, 'validateType']);
        $this->data = $data;
        $this->positions = array_keys($this->data);
    }

    /**
     * @return Data
     */
    public function current()
    {
        return $this->data[$this->positions[$this->position]];
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
        return count($this->data);
    }

    /**
     * @param Data $element
     * @throws InvalidCollectionItemTypeException
     */
    public function validateType($element)
    {
        if (!$element instanceof Data) {
            throw new InvalidCollectionItemTypeException;
        }
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
        return array_map(function ($data) {
            /** @var Data $data */
            return $data->getAsArray();
        }, $this->data);
    }
}

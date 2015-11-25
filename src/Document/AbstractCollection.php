<?php

namespace Json\Document;

use Json\Document\Data;
use Json\Exceptions\InvalidCollectionItemTypeException;
use Json\IRecursively;

/**
 * Class AbstractCollection
 * @package Json\Document
 */
abstract class AbstractCollection implements \Iterator, \Countable, IRecursively
{

    const COLLECTION_NAME = 'collectionName';

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var array
     */
    private $positions = [];

    /**
     * @var Meta[]|Links[]|Relationships[]|Data[]
     */
    private $items;

    /**
     * @param Meta[]|Links[]|Relationships[]|Data[] $items
     * @throws InvalidCollectionItemTypeException
     */
    public function __construct(array $items)
    {
        /**
         * @var Meta|Data|Links|Relationships $item
         */
        foreach ($items as $item) {
            if (false === $this->validateType($item)) {
                throw new InvalidCollectionItemTypeException;
            }

            if (is_callable([$item, 'getName'])) {
                $this->items[$item->getName()] = $item;
            } else {
                $this->items[] = $item;
            }
        }

        $this->positions = array_keys($this->items);
    }

    /**
     * @return Meta
     */
    public function current()
    {
        return $this->items[$this->positions[$this->position]];
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
        return count($this->items);
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
        return array_map(function ($item) {
            /** @var Meta|Data|Links|Relationships $item */
            return $item->getAsArray();
        }, $this->items);
    }

    /**
     * @param Meta|Data|Links|Relationships $element
     * @return bool
     */
    abstract protected function validateType($element);
}

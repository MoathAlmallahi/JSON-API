<?php

namespace Json\Document;

use Json\Document\Data;
use Json\Exceptions\InvalidCollectionItemTypeException;
use Json\IRecursively;

/**
 * Class AbstractCollection
 * @package Json\Document
 */
abstract class AbstractCollection implements \Iterator, \Countable, \ArrayAccess, IRecursively
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
        $collectionAsArray = [];
        array_map(function ($item) use (&$collectionAsArray) {
            /** @var Meta|Data|Links|Relationships $item */
            $collectionAsArray = array_merge($item->getAsArray(), $collectionAsArray);
        }, $this->items);

        return $collectionAsArray;
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return isset($this->items[$offset]) ? clone $this->items[$offset] : null;
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /**
     * @param Meta|Data|Links|Relationships $element
     * @return bool
     */
    abstract protected function validateType($element);
}

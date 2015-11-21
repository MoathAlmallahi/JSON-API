<?php

namespace Json\Object;

use Json\Exceptions\InvalidMetaException;
use Json\IRecursively;

/**
 * Class Meta
 * @package Json\Object
 */
class Meta implements IRecursively
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|array
     */
    private $value;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|array
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Meta constructor.
     * @param string $name
     * @param string|array $value
     * @throws InvalidMetaException
     */
    public function __construct($name, $value)
    {
        if (
            null === $value ||
            (is_object($value) && empty((array)$value))
        ) {
            throw new InvalidMetaException;
        }
        $this->name = $name;
        $this->value = is_object($value) ? (array)$value : $value;
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
        return [$this->getName() => $this->getValue()];
    }
}
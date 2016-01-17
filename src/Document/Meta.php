<?php

namespace Json\Document;

use Json\Exceptions\InvalidMetaException;
use Json\IRecursively;

/**
 * Class Meta
 * @package Json\Document
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
     * Meta constructor.
     * @param string $name
     * @param string|array $value
     * @throws InvalidMetaException
     */
    public function __construct($name, $value)
    {
        if (empty($value) || empty($name) || !is_string($name) || (is_object($value) && empty((array)$value))) {
            throw new InvalidMetaException;
        }

        $this->name = $name;
        $this->value = $value;
    }

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
        return [
            $this->getName() => is_object($this->getValue()) ? (array) $this->getValue() : $this->getValue()
        ];
    }
}

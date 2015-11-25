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
        $keysFilter = null;

        if (is_array($value)) {
            $keysFilter = array_filter($value, function ($key) {
                return is_int($key);
            }, ARRAY_FILTER_USE_KEY);
        }

        if (
            empty($value) || empty($name) || !is_string($name) || 0 < count($keysFilter)
        ) {
            throw new InvalidMetaException;
        }

        $this->name = $name;
        $this->value = $value;
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
        return $this->getValue();
    }
}

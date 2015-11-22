<?php

namespace Json\Document\Error;

use Json\Exceptions\InvalidErrorSourceException;
use Json\IRecursively;

/**
 * Class Source
 * @package Json\Document
 */
class Source implements IRecursively
{

    const FIELD_POINTER = 'pointer';
    const FIELD_PARAMETER = 'parameter';

    /**
     * @var string
     */
    private $pointer;

    /**
     * @var string
     */
    private $parameter;

    /**
     * @return mixed
     */
    public function getPointer()
    {
        return $this->pointer;
    }

    /**
     * @return mixed
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Source constructor.
     * @param string $pointer
     * @param string $parameter
     * @throws InvalidErrorSourceException
     */
    public function __construct($pointer = null, $parameter = null)
    {
        if (null === $pointer && null === $parameter) {
            throw new InvalidErrorSourceException;
        }
        $this->pointer = $pointer;
        $this->parameter = $parameter;
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
        $source = [
            static::FIELD_POINTER => $this->getPointer(),
            static::FIELD_PARAMETER => $this->getParameter()
        ];

        return array_filter($source);
    }
}

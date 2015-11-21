<?php

namespace Json\Object;

use Json\Exceptions\InvalidErrorSourceException;

/**
 * Class Source
 * @package Json\Object
 */
class Source
{

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
}

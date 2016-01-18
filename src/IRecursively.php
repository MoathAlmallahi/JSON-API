<?php

namespace Json;

/**
 * Interface IRecursively
 * @package Json
 */
interface IRecursively
{

    /**
     * Returns json encoded value or null
     * @return string|null
     */
    public function getAsJson();

    /**
     * Returns the json as array
     * @return array
     */
    public function getAsArray();
}

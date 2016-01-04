<?php

namespace Json\Document\Builder;

use Json\Document\Error;
use Json\Document\IBuilder;

/**
 * Interface ErrorInterface
 * @package Json\Document\Builder
 */
interface ErrorInterface extends IBuilder
{
    /**
     * @return Error\Builder
     */
    public function getErrorCollectionBuilder();

    /**
     * @param Error\Collection $errorCollection
     * @return static
     */
    public function setErrorCollection(Error\Collection $errorCollection);
}

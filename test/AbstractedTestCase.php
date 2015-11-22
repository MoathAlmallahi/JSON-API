<?php

namespace JsonTest;

use Json\Factory;

/**
 * Class Abstracted
 * @package JsonTest
 */
abstract class AbstractedTestCase extends \PHPUnit_Framework_TestCase
{
    private $jsonFactory;

    /**
     * constructor
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->jsonFactory = new Factory();
    }

    /**
     * @return Factory
     */
    protected function getJsonFactory()
    {
        return $this->jsonFactory;
    }
}

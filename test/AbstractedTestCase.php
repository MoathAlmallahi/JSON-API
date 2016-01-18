<?php

namespace JsonTest;

use Json\Document\Links;
use Json\Document\Meta;
use Json\Document\Relationships;
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

    /**
     * @return Meta\Collection
     */
    protected function createMetaCollection()
    {
        $meta1 = new Meta('key', 'value');
        $meta2 = new Meta('keyArray', ['key' => 'value']);

        return new Meta\Collection([$meta1, $meta2]);
    }

    /**
     * @return Links\Collection
     */
    protected function createLinksCollection()
    {
        $links1 = new Links('self', 'http://www.github.com');
        $links2 = new Links('related', 'http://www.bitbucket.org', $this->createMetaCollection());

        return new Links\Collection([$links1, $links2]);
    }

    /**
     * @return Relationships\Collection
     */
    protected function createRelationshipsCollection()
    {
        $rs1 = new Relationships('brother', $this->createLinksCollection(), null, $this->createMetaCollection());
        $rs2 = new Relationships('sister', $this->createLinksCollection(), null, $this->createMetaCollection());

        return new Relationships\Collection([$rs1, $rs2]);
    }
}

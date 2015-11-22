<?php

namespace JsonTest\Document;

use Json\Exceptions\InvalidMetaException;
use Json\Document\Meta;
use JsonTest\AbstractedTestCase;

/**
 * Class MetaTest
 * @package Json\Document
 */
class MetaTest extends AbstractedTestCase
{
    /**
     * Test the creation of Meta successfully
     */
    public function testSuccessfulMeta()
    {
        $name = 'Foo';
        $value = 'Bar';
        $meta = new Meta($name, $value);

        $this->assertEquals($name, $meta->getName());
        $this->assertEquals($value, $meta->getValue());
        $this->assertEquals($value, $meta->getAsArray()[$name]);
        $this->assertArrayHasKey($name, $meta->getAsArray());

        return $meta;
    }

    /**
     * Test the creation of Meta successfully with an Document value
     */
    public function testSuccessfulMetaWithDocumentValue()
    {
        $name = 'Foo';
        $value = new \StdClass;
        $value->Foo = 'Bar';
        $value->Bar = 'Foo';
        $arrayValue = (array)$value;
        $meta = new Meta($name, $value);

        $this->assertEquals($name, $meta->getName());
        $this->assertEquals($arrayValue, $meta->getValue());
        $this->assertEquals($arrayValue, $meta->getAsArray()[$name]);
        $this->assertArrayHasKey($name, $meta->getAsArray());

        return $meta;
    }

    /**
     * Test the creation of Meta successfully with an Document value
     */
    public function testInvalidMetaWithEmptyDocument()
    {
        $this->setExpectedException(InvalidMetaException::class);
        $name = 'Foo';
        $value = new \StdClass;
        $meta = new Meta($name, $value);
    }

    /**
     * Test the creation of Meta successfully
     */
    public function testInvalidMetaValue()
    {
        $this->setExpectedException(InvalidMetaException::class);
        $name = 'something';
        $value = null;
        $meta = new Meta($name, $value);
    }
}

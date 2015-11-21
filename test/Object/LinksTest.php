<?php

namespace JsonTest\Object;

use Json\Exceptions\InvalidLinkException;
use Json\Object\Links;
use JsonTest\AbstractedTestCase;

/**
 * Class LinksTest
 * @package Json\Object
 */
class LinksTest extends AbstractedTestCase
{

    /**
     * Test creating a Links w/o meta
     */
    public function testSuccessfulWithoutMeta()
    {
        $name = 'self';
        $href = 'http://www.github.com';
        $links = new Links($name, $href);

        $jsonArray = $links->getAsArray();

        $this->assertEquals($name, $links->getName());
        $this->assertEquals($href, $links->getHref());
        $this->assertArrayHasKey($name, $jsonArray);
        $this->assertArrayHasKey($name, $jsonArray);
        $this->assertArrayNotHasKey(Links::FIELD_META, $jsonArray);

        return $links;
    }

    /**
     * Test creating a Links w/ meta
     */
    public function testSuccessfulWithMeta()
    {
        $name = 'self';
        $href = 'http://www.github.com';
        $meta = $this->createMetaCollection();
        $links = new Links($name, $href, $meta);

        $this->assertEquals($name, $links->getName());
        $this->assertEquals($href, $links->getHref());
        $this->assertEquals($meta, $links->getMeta());
        $this->assertArrayHasKey($name, $links->getAsArray());
        $this->assertArrayHasKey(Links::FIELD_HREF, $links->getAsArray()[$name]);
        $this->assertArrayHasKey(Links::FIELD_META, $links->getAsArray()[$name]);

        return $links;
    }

    /**
     * Test creating a Links w/ meta only
     */
    public function testSuccessfulWithMetaOnly()
    {
        $name = 'self';
        $href = null;
        $meta = $this->createMetaCollection();
        $links = new Links($name, $href, $meta);

        $this->assertEquals($name, $links->getName());
        $this->assertEquals($href, $links->getHref());
        $this->assertEquals($meta, $links->getMeta());
        $this->assertArrayHasKey($name, $links->getAsArray());
        $this->assertArrayNotHasKey(Links::FIELD_HREF, $links->getAsArray()[$name]);
        $this->assertArrayHasKey(Links::FIELD_META, $links->getAsArray()[$name]);

        return $links;
    }

    /**
     * Test creating an invalid Links
     */
    public function testInvalidLinksException()
    {
        $this->setExpectedException(InvalidLinkException::class);
        $name = 'self';
        $href = null;
        $meta = null;
        $links = new Links($name, $href, $meta);
    }
}

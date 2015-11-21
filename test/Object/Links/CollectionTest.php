<?php

namespace JsonTest\Object\Links;

use Json\Object\Links;
use JsonTest\AbstractedTestCase;

/**
 * Class CollectionTest
 * @package Json\Object\Links
 */
class CollectionTest extends AbstractedTestCase
{
    /**
     * @depends LinksTest::testSuccessfulWithoutMeta
     * @depends LinksTest::testSuccessfulWithMeta
     * @param Links $linksWithoutMeta
     * @param Links $linksWithMeta
     * @return Links\Collection
     */
    public function testCreateSuccessfulCollection($linksWithoutMeta, $linksWithMeta)
    {
        $linksCollection = new Links\Collection([$linksWithMeta, $linksWithoutMeta]);
        $this->assertEquals(2, $linksCollection->count());
        $this->assertEquals(2, count($linksCollection));

        return $linksCollection;
    }
}

<?php

namespace JsonTest\Document\Links;

use Json\Document\Links;
use JsonTest\AbstractedTestCase;

/**
 * Class CollectionTest
 * @package Json\Document\Links
 */
class CollectionTest extends AbstractedTestCase
{
    /**
     * test creating a links collection successfully
     */
    public function testCreateSuccessfulCollection()
    {
        $link1 = $this->getJsonFactory()->createLinks('link1', 'http://www.github.com');
        $link2 = $this->getJsonFactory()->createLinks('link1', 'http://www.github.com');

        $linksCollection = new Links\Collection([$link1, $link2]);

        $this->assertEquals(2, $linksCollection->count());
        $this->assertEquals(2, count($linksCollection));

        return $linksCollection;
    }
}

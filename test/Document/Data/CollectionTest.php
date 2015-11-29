<?php

namespace JsonTest\Document\Data;

use Json\Document\Data;
use JsonTest\AbstractedTestCase;

/**
 * Class Collection
 * @package Json\Document\Data
 */
class CollectionTest extends AbstractedTestCase
{
    public function testDataCollection()
    {
        $data1 = new Data('article', 1);
        $data2 = new Data('article', 2);

        $dataCollection = new Data\Collection([$data1, $data2]);

        $this->assertEquals(2, $dataCollection->count());
        $this->assertEquals($data1->getAsArray(), $dataCollection[0]->getAsArray());
    }
}

<?php

namespace JsonTest\Document\Data;

use Json\Document\Data;
use Json\Document\Meta;
use Json\Exceptions\InvalidCollectionItemTypeException;
use JsonTest\AbstractedTestCase;

/**
 * Class Collection
 * @package Json\Document\Data
 */
class CollectionTest extends AbstractedTestCase
{
    /**
     * @param array $collectionItems
     * @param null|string $exception
     * @dataProvider dataProviderTestDataCollection
     */
    public function testDataCollection(array $collectionItems, $exception = null)
    {
        if (null !== $exception) {
            $this->setExpectedException($exception);
        }
        $dataCollection = new Data\Collection($collectionItems);

        $this->assertEquals(count($collectionItems), $dataCollection->count());

        $count = 0;
        foreach ($dataCollection as $data) {
            $this->assertEquals($collectionItems[$count], $data);
            $count++;
        }
    }

    /**
     * @return array
     */
    public function dataProviderTestDataCollection()
    {
        return [
            'successful collection' => [
                'collectionItems' => [
                    new Data('article', 1),
                    new Data('article', 2)
                ]
            ],
            'failure with different type' => [
                'collectionItems' => [
                    new Data('article', 1),
                    new Meta('key', 'value')
                ],
                'exception' => InvalidCollectionItemTypeException::class
            ]
        ];
    }
}

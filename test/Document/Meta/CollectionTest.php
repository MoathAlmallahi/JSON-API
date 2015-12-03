<?php

namespace JsonTest\Document\Meta;

use Json\Document\Links;
use Json\Document\Meta;
use Json\Exceptions\InvalidCollectionItemTypeException;
use JsonTest\AbstractedTestCase;

/**
 * Class CollectionTest
 * @package Json\Document\Meta
 */
class CollectionTest extends AbstractedTestCase
{
    /**
     * @param array $collectionItems
     * @param null|string $exception
     * @dataProvider dataProviderTestMetaCollection
     */
    public function testMetaCollection(array $collectionItems, $exception = null)
    {
        if (null !== $exception) {
            $this->setExpectedException($exception);
        }
        $metaCollection = new Meta\Collection($collectionItems);

        $this->assertEquals(count($collectionItems), $metaCollection->count());

        $count = 0;
        foreach ($metaCollection as $name => $meta) {
            $this->assertEquals($collectionItems[$count], $meta);
            $this->assertEquals($collectionItems[$count], $metaCollection[$name]);

            $this->assertEquals(true, isset($metaCollection[$name]));
            $count++;
        }
    }

    /**
     * @return array
     */
    public function dataProviderTestMetaCollection()
    {
        return [
            'successful collection' => [
                'collectionItems' => [
                    new Meta('key1', 'value1'),
                    new Meta('key2', 'value2'),
                ]
            ],
            'failure with different type' => [
                'collectionItems' => [
                    new Links('self', 'http://www.github.com'),
                    new Meta('key', 'value')
                ],
                'exception' => InvalidCollectionItemTypeException::class
            ]
        ];
    }
}

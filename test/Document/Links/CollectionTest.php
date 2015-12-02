<?php

namespace JsonTest\Document\Links;

use Json\Document\Links;
use Json\Document\Meta;
use Json\Exceptions\InvalidCollectionItemTypeException;
use JsonTest\AbstractedTestCase;

/**
 * Class CollectionTest
 * @package Json\Document\Links
 */
class CollectionTest extends AbstractedTestCase
{
    /**
     * @param array $collectionItems
     * @param null|string $exception
     * @dataProvider dataProviderTestLinksCollection
     */
    public function testLinksCollection(array $collectionItems, $exception = null)
    {
        if (null !== $exception) {
            $this->setExpectedException($exception);
        }
        $linksCollection = new Links\Collection($collectionItems);

        $this->assertEquals(count($collectionItems), $linksCollection->count());

        $count = 0;
        foreach ($linksCollection as $name => $links) {
            $this->assertEquals($collectionItems[$count], $links);
            $this->assertEquals($collectionItems[$count], $linksCollection[$name]);
            $count++;
        }
    }

    /**
     * @return array
     */
    public function dataProviderTestLinksCollection()
    {
        return [
            'successful collection' => [
                'collectionItems' => [
                    new Links('self', 'http://www.github.com'),
                    new Links('related', 'http://www.github.com'),
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

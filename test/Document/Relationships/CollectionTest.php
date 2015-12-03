<?php

namespace JsonTest\Document\Relationships;

use Json\Document\Meta;
use Json\Document\Relationships;
use Json\Exceptions\InvalidCollectionItemTypeException;
use JsonTest\AbstractedTestCase;

/**
 * Class CollectionTest
 * @package Json\Document\Relationships
 */
class CollectionTest extends AbstractedTestCase
{
    /**
     * @param array $collectionItems
     * @param null|string $exception
     * @dataProvider dataProviderTestRelationshipsCollection
     */
    public function testRelationshipsCollection(array $collectionItems, $exception = null)
    {
        if (null !== $exception) {
            $this->setExpectedException($exception);
        }
        $relationshipsCollection = new Relationships\Collection($collectionItems);

        $this->assertEquals(count($collectionItems), count($relationshipsCollection));

        $this->setExpectedException(\Exception::class, 'Cannot assign an item');
        $relationshipsCollection['test'] = null;

        $count = 0;
        foreach ($relationshipsCollection as $name => $relationship) {
            $this->assertEquals($collectionItems[$count], $relationship);
            $this->assertEquals($collectionItems[$count], $relationshipsCollection[$name]);

            $this->setExpectedException(\Exception::class, 'Cannot unset an item');
            unset($relationshipsCollection[$name]);

            $this->assertNotEquals(null, $relationshipsCollection[$name]);
            $this->assertEquals(true, isset($relationshipsCollection[$name]));
            $count++;
        }
    }

    /**
     * @return array
     */
    public function dataProviderTestRelationshipsCollection()
    {
        return [
            'successful collection' => [
                'collectionItems' => [
                    new Relationships('brother1', $this->createLinksCollection()),
                    new Relationships('brother2', $this->createLinksCollection())
                ]
            ],
            'failure with different type' => [
                'collectionItems' => [
                    new Relationships('brother1', $this->createLinksCollection()),
                    new Meta('key', 'value')
                ],
                'exception' => InvalidCollectionItemTypeException::class
            ]
        ];
    }
}

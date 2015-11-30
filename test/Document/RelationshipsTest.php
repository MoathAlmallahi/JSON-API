<?php

namespace JsonTest\Document;

use Json\Document\Relationships;
use Json\Exceptions\InvalidRelationshipsException;
use JsonTest\AbstractedTestCase;

/**
 * Class RelationshipsTest
 * @package Json\Document
 */
class RelationshipsTest extends AbstractedTestCase
{
    /**
     * @dataProvider dataProviderTestRelationships
     * @param array $attributes
     * @param null|array $expected
     * @param null|string $exception
     */
    public function testRelationships($attributes, $expected = null, $exception = null)
    {
        if (null !== $exception) {
            $this->setExpectedException($exception);
        }

        $rs = new Relationships(
            $attributes['name'],
            $attributes[Relationships::FIELD_LINKS],
            $attributes[Relationships::FIELD_DATA],
            $attributes[Relationships::FIELD_META]
        );
    }

    /**
     * @return array
     */
    public function dataProviderTestRelationships()
    {
        return [
            'successful - full relationships' => [
                'attributes' => [
                    'name' => 'something',
                    Relationships::FIELD_LINKS => $this->createLinksCollection(),
                    Relationships::FIELD_DATA => null,
                    Relationships::FIELD_META => $this->createMetaCollection()
                ],
                'expected' => [
                    'something' => [
                        Relationships::FIELD_LINKS => $this->createLinksCollection()->getAsArray(),
                        Relationships::FIELD_META => $this->createMetaCollection()->getAsArray()
                    ]
                ]
            ],
            'failure' => [
                'attributes' => [
                    'name' => 'something',
                    Relationships::FIELD_LINKS => null,
                    Relationships::FIELD_DATA => null,
                    Relationships::FIELD_META => null
                ],
                'expected' => null,
                'exception' => InvalidRelationshipsException::class
            ]
        ];
    }
}

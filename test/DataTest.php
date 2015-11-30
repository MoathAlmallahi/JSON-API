<?php

namespace JsonTest;

use Json\Document\Data;
use Json\Document\Links;
use Json\Document\Meta;
use Json\Document\Relationships;
use Json\Exceptions\InvalidDataException;

/**
 * Class DataTest
 * @package JsonTest
 */
class DataTest extends AbstractedTestCase
{
    /**
     * @param array $attributes
     * @param array $expectedArrayHasKeys
     * @param array $expectedArrayNotHasKeys
     * @param null|string $exception
     * @dataProvider dataProviderDataTest
     */
    public function testData(
        array $attributes,
        array $expectedArrayHasKeys = [],
        array $expectedArrayNotHasKeys = [],
        $exception = null
    ) {
        if (null !== $exception) {
            $this->setExpectedException($exception);
        }

        $data = new Data(
            $attributes[Data::FIELD_TYPE],
            $attributes[Data::FIELD_ID],
            $attributes[Data::FIELD_ATTRIBUTES],
            $attributes[Data::FIELD_RELATIONSHIPS],
            $attributes[Data::FIELD_LINKS],
            $attributes[Data::FIELD_META]
        );

        $dataArray = $data->getAsArray()[0];

        foreach ($expectedArrayHasKeys as $existedKey) {
            $attribute = is_object($attributes[$existedKey]) ?
                $attributes[$existedKey]->getAsArray() : $attributes[$existedKey];

            $this->assertArrayHasKey($existedKey, $dataArray);
            $this->assertEquals($attribute, $dataArray[$existedKey]);
        }

        foreach ($expectedArrayNotHasKeys as $notExistedKey) {
            $this->assertArrayNotHasKey($notExistedKey, $dataArray);
        }
    }

    /**
     * @return array
     */
    public function dataProviderDataTest()
    {
        return [
            'successful - complete data' => [
                'attributes' => [
                    Data::FIELD_TYPE => 'person',
                    Data::FIELD_ID => 1,
                    Data::FIELD_ATTRIBUTES => [
                        'firstName' => 'Foo',
                        'lastName' => 'Bar'
                    ],
                    Data::FIELD_RELATIONSHIPS => $this->createRelationshipsCollection(),
                    Data::FIELD_LINKS => $this->createLinksCollection(),
                    Data::FIELD_META => $this->createMetaCollection()
                ],
                'expectedArrayHasKeys' => [
                    Data::FIELD_TYPE,
                    Data::FIELD_ID,
                    Data::FIELD_ATTRIBUTES,
                    Data::FIELD_RELATIONSHIPS,
                    Data::FIELD_LINKS,
                    Data::FIELD_META
                ]
            ],
            'successful - no id' => [
                'attributes' => [
                    Data::FIELD_TYPE => 'person',
                    Data::FIELD_ID => null,
                    Data::FIELD_ATTRIBUTES => [
                        'firstName' => 'Foo',
                        'lastName' => 'Bar'
                    ],
                    Data::FIELD_RELATIONSHIPS => $this->createRelationshipsCollection(),
                    Data::FIELD_LINKS => $this->createLinksCollection(),
                    Data::FIELD_META => $this->createMetaCollection()
                ],
                'expectedArrayHasKeys' => [
                    Data::FIELD_TYPE,
                    Data::FIELD_ATTRIBUTES,
                    Data::FIELD_RELATIONSHIPS,
                    Data::FIELD_LINKS,
                    Data::FIELD_META
                ],
                'expectedArrayNotHasKeys' => [
                    Data::FIELD_ID
                ]
            ],
            'failure - no id, type' => [
                'attributes' => [
                    Data::FIELD_TYPE => null,
                    Data::FIELD_ID => null,
                    Data::FIELD_ATTRIBUTES => [
                        'firstName' => 'Foo',
                        'lastName' => 'Bar'
                    ],
                    Data::FIELD_RELATIONSHIPS => $this->createRelationshipsCollection(),
                    Data::FIELD_LINKS => $this->createLinksCollection(),
                    Data::FIELD_META => $this->createMetaCollection()
                ],
                'expectedArrayHasKeys' => [],
                'expectedArrayNotHasKeys' => [],
                'exception' => InvalidDataException::class
            ]
        ];
    }
}

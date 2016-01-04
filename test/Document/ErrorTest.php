<?php

namespace JsonTest\Document;

use Json\Document\Error;
use JsonTest\AbstractedTestCase;

/**
 * Class ErrorTest
 * @package JsonTest\Document
 */
class ErrorTest extends AbstractedTestCase
{

    /**
     * Test creating a Links w/o meta
     * @param array $attributes
     * @param $expected
     * @dataProvider dataProviderTestErrorSuccessful
     */
    public function testErrorSuccessful(array $attributes, $expected = null)
    {
        $error = new Error(
            $attributes[Error::FIELD_ID],
            $attributes[Error::FIELD_STATUS],
            $attributes[Error::FIELD_CODE],
            $attributes[Error::FIELD_TITLE],
            $attributes[Error::FIELD_DETAIL],
            $attributes[Error::FIELD_SOURCE],
            $attributes[Error::FIELD_LINKS],
            $attributes[Error::FIELD_META]
        );

        $this->assertEquals($expected, $error->getAsArray());
    }

    /**
     * @return array
     */
    public function dataProviderTestErrorSuccessful()
    {
        return [
            'successful - full error' => [
                'attributes' => [
                    Error::FIELD_ID => 123,
                    Error::FIELD_STATUS => 1,
                    Error::FIELD_CODE => 404,
                    Error::FIELD_TITLE => 'the error title',
                    Error::FIELD_DETAIL => 'the error details',
                    Error::FIELD_SOURCE => $source = new Error\Source('/some/pointer', 'the id is missing'),
                    Error::FIELD_LINKS => $this->createLinksCollection(),
                    Error::FIELD_META => $this->createMetaCollection()
                ],
                'expected' => [
                    [
                        Error::FIELD_ID => 123,
                        Error::FIELD_STATUS => 1,
                        Error::FIELD_CODE => 404,
                        Error::FIELD_TITLE => 'the error title',
                        Error::FIELD_DETAIL => 'the error details',
                        Error::FIELD_SOURCE => $source->getAsArray(),
                        Error::FIELD_LINKS => $this->createLinksCollection()->getAsArray(),
                        Error::FIELD_META => $this->createMetaCollection()->getAsArray()
                    ]
                ]
            ]
        ];
    }
}

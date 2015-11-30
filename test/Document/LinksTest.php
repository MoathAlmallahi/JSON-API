<?php

namespace JsonTest\Document;

use Json\Document\Meta;
use Json\Exceptions\InvalidLinkException;
use Json\Document\Links;
use JsonTest\AbstractedTestCase;

/**
 * Class LinksTest
 * @package Json\Document
 */
class LinksTest extends AbstractedTestCase
{
    /**
     * Test creating a Links w/o meta
     * @param array $attributes
     * @param $expected
     * @param $exception
     * @dataProvider dataProviderTestLinks
     */
    public function testLinks(array $attributes, $expected = null, $exception = null)
    {
        if (null !== $exception) {
            $this->setExpectedException($exception);
        }

        $links = new Links($attributes['name'], $attributes[Links::FIELD_HREF], $attributes[Links::FIELD_META]);

        $this->assertEquals($expected, $links->getAsArray());
    }

    /**
     * @return array
     */
    public function dataProviderTestLinks()
    {
        return [
            'successful - full links' => [
                'attributes' => [
                    'name' => 'self',
                    Links::FIELD_HREF => 'http://www.github.com',
                    Links::FIELD_META => $this->createMetaCollection()
                ],
                'expected' => [
                    'self' => [
                        Links::FIELD_HREF => 'http://www.github.com',
                        Links::FIELD_META => $this->createMetaCollection()->getAsArray()
                    ]
                ]
            ],
            'successful - no href' => [
                'attributes' => [
                    'name' => 'self',
                    Links::FIELD_HREF => null,
                    Links::FIELD_META => $this->createMetaCollection()
                ],
                'expected' => [
                    'self' => [
                        Links::FIELD_META => $this->createMetaCollection()->getAsArray()
                    ]
                ]
            ],
            'successful - no meta' => [
                'attributes' => [
                    'name' => 'self',
                    Links::FIELD_HREF => 'http://www.github.com',
                    Links::FIELD_META => null
                ],
                'expected' => [
                    'self' => 'http://www.github.com',
                ]
            ],
            'invalid - exception' => [
                'attributes' => [
                    'name' => 'self',
                    Links::FIELD_HREF => null,
                    Links::FIELD_META => null
                ],
                'expected' => [],
                'exception' => InvalidLinkException::class
            ]
        ];
    }
}

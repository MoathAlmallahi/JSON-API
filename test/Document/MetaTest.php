<?php

namespace JsonTest\Document;

use Json\Exceptions\InvalidMetaException;
use Json\Document\Meta;
use JsonTest\AbstractedTestCase;

/**
 * Class MetaTest
 * @package Json\Document
 */
class MetaTest extends AbstractedTestCase
{
    /**
     * Test creating a Meta w/o meta
     * @param array $attributes
     * @param $expected
     * @param $exception
     * @dataProvider dataProviderTestMeta
     */
    public function testMeta(array $attributes, $expected = null, $exception = null)
    {
        if (null !== $exception) {
            $this->setExpectedException($exception);
        }

        $links = new Meta($attributes['name'], $attributes['value']);

        $this->assertEquals($expected, $links->getAsArray());
    }

    /**
     * @return array
     */
    public function dataProviderTestMeta()
    {
        return [
            'successful' => [
                'attributes' => [
                    'name' => 'Foo',
                    'value' => 'Bar'
                ],
                'expected' => [
                    'Foo' => 'Bar'
                ]
            ],
            'failure' => [
                'attributes' => [
                    'name' => 'Foo',
                    'value' => null
                ],
                'expected' => null,
                'exception' => InvalidMetaException::class
            ]
        ];
    }
}

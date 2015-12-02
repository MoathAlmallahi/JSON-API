<?php

namespace JsonTest\Document\Error;

use Json\Document\Error\Source;
use Json\Exceptions\InvalidErrorSourceException;
use JsonTest\AbstractedTestCase;

/**
 * Class SourceTest
 * @package JsonTest\Document\Error
 */
class SourceTest extends AbstractedTestCase
{
    /**
     * @dataProvider dataProviderTestSource
     * @param array $attributes
     * @param array $expected
     * @param null|string $exception
     */
    public function testSource(array $attributes, $expected, $exception = null)
    {
        if (null !== $exception) {
            $this->setExpectedException($exception);
        }

        $source = new Source(
            $attributes[Source::FIELD_POINTER],
            $attributes[Source::FIELD_PARAMETER]
        );

        $this->assertEquals($expected, $source->getAsArray());
    }

    /**
     * @return array
     */
    public function dataProviderTestSource()
    {
        return [
            'successful source - full data' => [
                'attributes' => [
                    Source::FIELD_POINTER => '/foo/bar',
                    Source::FIELD_PARAMETER => 'Foo'
                ],
                'expected' => [
                    'pointer' => '/foo/bar',
                    'parameter' => 'Foo'
                ]
            ],
            'successful source - only pointer' => [
                'attributes' => [
                    Source::FIELD_POINTER => '/foo/bar',
                    Source::FIELD_PARAMETER => null
                ],
                'expected' => [
                    'pointer' => '/foo/bar'
                ]
            ],
            'successful source - only parameter' => [
                'attributes' => [
                    Source::FIELD_POINTER => null,
                    Source::FIELD_PARAMETER => 'Foo'
                ],
                'expected' => [
                    'parameter' => 'Foo'
                ]
            ],
            'failure source' => [
                'attributes' => [
                    Source::FIELD_POINTER => null,
                    Source::FIELD_PARAMETER => null
                ],
                'expected' => [],
                'exception' => InvalidErrorSourceException::class
            ],
        ];
    }
}
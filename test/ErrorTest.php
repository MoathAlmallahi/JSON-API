<?php

namespace JsonTest;

use Json\Document\Error;
use Json\Document\Links;
use Json\Document\Meta;
use Json\Exceptions\InvalidErrorException;

/**
 * Class ErrorTest
 * @package Json\Object
 */
class ErrorTest extends AbstractedTestCase
{
    /**
     * @param array $attributes
     * @param array $expectedArrayHasKeys
     * @param array $expectedArrayNotHasKeys
     * @param string|null $exception
     * @dataProvider dataProviderErrorTest
     */
    public function testError(
        array $attributes,
        array $expectedArrayHasKeys,
        array $expectedArrayNotHasKeys,
        $exception = null
    ) {
        if (null !== $exception) {
            $this->setExpectedException(InvalidErrorException::class);
        }

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

        $errorArray = $error->getAsArray()[0];

        foreach ($expectedArrayHasKeys as $key) {
            $this->assertArrayHasKey($key, $errorArray);
        }

        foreach ($expectedArrayNotHasKeys as $key) {
            $this->assertArrayNotHasKey($key, $errorArray);
        }
    }

    /**
     * @return array
     */
    public function dataProviderErrorTest()
    {
        return [
            'successful - complete error' => [
                'attributes' => [
                    Error::FIELD_ID => 1,
                    Error::FIELD_STATUS => '404',
                    Error::FIELD_CODE => 90,
                    Error::FIELD_TITLE => 'error title',
                    Error::FIELD_DETAIL => 'error details goes here',
                    Error::FIELD_SOURCE => new Error\Source('/foo/bar', 'foo'),
                    Error::FIELD_LINKS => $this->getJsonFactory()->createLinksCollection(
                        [
                            $this->getJsonFactory()->createLinks('self', 'http://www.bitbucket.org'),
                            $this->getJsonFactory()->createLinks('related', 'http://www.github.com')
                        ]
                    ),
                    Error::FIELD_META => $this->getJsonFactory()->createMetaCollection(
                        [
                            $this->getJsonFactory()->createMeta('metaKey', 'metaValue'),
                            $this->getJsonFactory()->createMeta('metaArrayKey', ['key' => 'value'])
                        ]
                    )
                ],
                'expectedArrayHasKeys' => [
                    Error::FIELD_ID,
                    Error::FIELD_STATUS,
                    Error::FIELD_CODE,
                    Error::FIELD_TITLE,
                    Error::FIELD_DETAIL,
                    Error::FIELD_SOURCE,
                    Error::FIELD_LINKS,
                    Error::FIELD_META
                ],
                'expectedArrayNotHasKeys' => []
            ]
        ];
    }
}

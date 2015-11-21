<?php

namespace JsonTest;

use Json\Data;
use Json\Object\Links;

/**
 * Class DataTest
 * @package JsonTest
 */
class DataTest extends AbstractedTestCase
{

    public function testMe()
    {
        $this->assertEquals(1,1);
    }
    /**
     * @dataProvider testDataProvider
     * @param array $attributes
     * @param array $expected The attributes values
     * @param string $exception Exception name
     */
//    public function testData($attributes, $expected, $exception)
//    {
//        if (null !== $exception) {
//            $this->setExpectedException(
//                $exception
//            );
//        }
//        $data = new Data(
//            $attributes[Data::FIELD_TYPE],
//            $attributes[Data::FIELD_ID],
//            $attributes[Data::FIELD_ATTRIBUTES],
//            $attributes[Data::FIELD_RELATIONSHIPS],
//            $attributes[Data::FIELD_LINKS],
//            $attributes[Data::FIELD_META]
//        );
//
//    }

    /**
     * @return array
     */
//    public function testDataProvider()
//    {
//        $links = $this->createLinksCollectionWithMeta();
//        $relationships = $this->createRelationshipsCollection();
//        $meta = $this->createMetaCollection();
//
//        return [
//            'Complete' => [
//                '$attributes' => [
//                    Data::FIELD_TYPE => 'test',
//                    Data::FIELD_ID => 1,
//                    Data::FIELD_ATTRIBUTES => [
//                        'firstName' => 'Foo',
//                        'lastName' => 'Bar'
//                    ],
//                    Data::FIELD_RELATIONSHIPS => $relationships,
//                    Data::FIELD_LINKS => $links,
//                    Data::FIELD_META => $meta
//                ],
//                '$expected' => '',
//                '$exception' => null
//            ]
//        ];
//    }

}

<?php

namespace JsonTest\Document\Data;

use JsonTest\AbstractedTestCase;
use Json;

/**
 * Class BuilderTest
 * @package JsonTest\Document\Data
 */
class BuilderTest extends AbstractedTestCase
{
    /**
     * @param \Closure $builder
     * @param array $expected
     * @dataProvider dataProviderTestSuccessfulBuilder
     */
    public function testSuccessfulBuilder($builder, $expected)
    {
        $factory = new Json\Factory();
        $document = new Json\Document\Builder($factory);

        $result = $builder($document);

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccessfulBuilder()
    {
        return [
            'full document build' => [
                'builder' => function ($documentBuilder) {
                    /** @var Json\Document\Builder $documentBuilder */
                    $dataBuilder = $documentBuilder->getDataCollectionBuilder();
                    $documentLinksBuilder = $documentBuilder->getLinksCollectionBuilder();
                    $documentMetaBuilder = $documentBuilder->getMetaCollectionBuilder();
                    $documentIncludedBuilder = $documentBuilder->getIncludedCollectionBuilder();

                    // building the document data
                    $dataBuilder
                        ->setId(1)
                        ->setAttributes([
                            'firstName' => 'Foo',
                            'lastName' => 'Bar',
                            'age' => 20,
                            'active' => true
                        ])
                        ->setType('person');

                    // setting data relationships
                    $dataRelationshipsBuilder = $dataBuilder->getRelationshipsCollectionBuilder();
                    $dataRelationshipsBuilder->setName('friends');

                    $dataRelationshipsDataBuilder = $dataRelationshipsBuilder->getDataCollectionBuilder();
                    $dataRelationshipsDataBuilder
                        ->setId(2)
                        ->setType('person')
                        ->setAttributes([
                            'firstName' => 'Foo 1',
                            'lastName' => 'Bar',
                            'age' => 20,
                            'active' => true
                        ]);
                    $dataRelationshipsDataBuilder->addData()->addToParent(); // added data to relationships

                    $dataRelationshipsLinksBuilder = $dataRelationshipsBuilder->getLinksCollectionBuilder();
                    $dataRelationshipsLinksBuilder
                        ->setName('self')
                        ->setHref('http://www.facebook.com/2');
                    $dataRelationshipsLinksBuilder->addLink()->addToParent(); // added links to relationships

                    $dataRelationshipsMetaBuilder = $dataRelationshipsBuilder->getMetaCollectionBuilder();
                    $dataRelationshipsMetaBuilder
                        ->setName('createdAt')
                        ->setValue('19 July');
                    $dataRelationshipsMetaBuilder->addMeta()->addToParent(); // added meta to relationships

                    $dataRelationshipsBuilder->addRelationships()->addToParent(); // added relationships to data

                    $dataBuilder->addData()->addToParent(); // added to the document
                    // finished relationships and added to document

                    // building the document links
                    $documentLinksBuilder
                        ->setName('self')
                        ->setHref('http://www.facebook.com/me')
                        ->addLink();
                    $documentLinksBuilder
                        ->setName('related')
                        ->setHref('http://www.facebook.com/1');
                    $documentLinksMetaBuilder = $documentLinksBuilder->getMetaCollectionBuilder();
                    $documentLinksMetaBuilder
                        ->setName('self')
                        ->setValue('yes')
                        ->addMeta()
                        ->addToParent();
                    $documentLinksBuilder->addLink()->addToParent(); // added links to the document
                    // finished building document links and added

                    // building the document meta
                    $documentMetaBuilder->setName('postsCount')->setValue(340)->addMeta();
                    $documentMetaBuilder->setName('friendsCount')->setValue(500)->addMeta();

                    $documentMetaBuilder->addToParent();
                    // finished document meta and added

                    return $documentBuilder->getDocument()->getAsJson();
                },
                'expected' => json_encode(
                    [
                        'data' => [
                            [
                                'type' => 'person',
                                'id' => 1,
                                'attributes' => [
                                    'firstName' => 'Foo',
                                    'lastName' => 'Bar',
                                    'age' => 20,
                                    'active' => true
                                ],
                                'relationships' => [
                                    'friends' => [
                                        'links' => [
                                            'self' => 'http://www.facebook.com/2'
                                        ],
                                        'data' => [
                                            [
                                                'type' => 'person',
                                                'id' => 2,
                                                'attributes' => [
                                                    'firstName' => 'Foo 1',
                                                    'lastName' => 'Bar',
                                                    'age' => 20,
                                                    'active' => true
                                                ]
                                            ]
                                        ],
                                        'meta' => [
                                            'createdAt' => '19 July'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'meta' => [
                            'friendsCount' => 500,
                            'postsCount' => 340
                        ],
                        'links' => [
                            'related' => [
                                'href' => 'http://www.facebook.com/1',
                                'meta' => [
                                    'self' => 'yes'
                                ]
                            ],
                            'self' => 'http://www.facebook.com/me'
                        ]
                    ]
                )
            ]
        ];
    }
}

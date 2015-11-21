<?php

namespace JsonTest\Object;

use Json\Object\Relationships;
use JsonTest\AbstractedTestCase;

/**
 * Class RelationshipsTest
 * @package Json\Object
 */
class RelationshipsTest extends AbstractedTestCase
{
    /**
     * s
     */
    public function testSuccessfulRelationshipsWithoutData()
    {
        $relationships = new Relationships(
            $this->createLinksCollectionWithMeta(),
            null,
            $this->createMetaCollection()
        );

        echo $relationships->getAsJson();
    }

    /**
     * s
     */
    public function testSuccessfulRelationshipsWithoutMeta()
    {
        $relationships = new Relationships(
            null,
            $this->createDataCollection(),
            $this->createMetaCollection()
        );

        echo $relationships->getAsJson();
        die;
    }
}

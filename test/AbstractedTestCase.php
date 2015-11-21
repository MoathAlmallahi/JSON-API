<?php

namespace JsonTest;

use Json\Object\Links;
use Json\Object\Meta;
use Json\Object\Relationships;

/**
 * Class Abstracted
 * @package JsonTest
 */
abstract class AbstractedTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @return Links\Collection
     */
    protected function createLinksCollectionWithoutMeta()
    {
        $links = [];
        $links[] = new Links('self', 'http://www.github.com');
        $links[] = new Links('self', 'http://www.bitbucket.com');

        return new Links\Collection($links);
    }

    /**
     * @return Links\Collection
     */
    protected function createLinksCollectionWithMeta()
    {
        $links = [];
        $links[] = new Links('self', 'http://www.github.com', $this->createMetaCollection());
        $links[] = new Links('self', 'http://www.bitbucket.com');

        return new Links\Collection($links);
    }

    /**
     * @return Meta\Collection
     */
    protected function createMetaCollection()
    {
        $meta = [];
        $meta[] = new Meta('field', 'some value');
        $meta[] = new Meta('authors', ['Beggie', 'SnoopDogg', 'Notorious']);

        return new Meta\Collection($meta);
    }

    /**
     *
     */
    protected function createRelationshipsCollection()
    {
        $relationships = [];
        $relationships[] = new Relationships(
            $this->createLinksCollectionWithMeta(),
            $this->createDataCollection(),
            $this->createMetaCollection()
        );

        return $relationships;
    }
}

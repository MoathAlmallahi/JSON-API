<?php
/**
 * Created by PhpStorm.
 * User: moath
 * Date: 15.11.15
 * Time: 18:17
 */

namespace Json;


use Json\Object\Links\Collection as LinksCollection;
use Json\Object\Meta\Collection as MetaCollection;
use Json\Object\Relationships\Collection as RelationshipsCollection;


interface ISkeleton
{

    /**
     * @return string
     */
    public function getType();

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return array|null
     */
    public function getAttributes();

    /**
     * @return RelationshipsCollection|null
     */
    public function getRelationships();

    /**
     * @return LinksCollection|null
     */
    public function getLinks();

    /**
     * @return MetaCollection|null
     */
    public function getMeta();


}
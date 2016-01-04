<?php

namespace Json\Document;

use Json\Exceptions\InvalidDataException;
use Json\IRecursively;

/**
 * Class Included
 * @package Json\Document
 */
class Included implements IRecursively
{

    const FIELD_TYPE = 'type';
    const FIELD_ID = 'id';
    const FIELD_ATTRIBUTES = 'attributes';
    const FIELD_RELATIONSHIPS = 'relationships';
    const FIELD_LINKS = 'links';
    const FIELD_META = 'meta';
    const FIELD_DATA = 'data';

    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $id;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @var Relationships\Collection|null
     */
    private $relationships;

    /**
     * @var Links\Collection|null
     */
    private $links;

    /**
     * @var Meta\Collection|null
     */
    private $meta;

    /**
     * @param string|null $type The type of the resource
     * @param mixed|null $id The unique ID of the resource
     * @param array|null $attributes an attributes object representing some of the resource's data
     * @param Relationships\Collection|null $relationships a relationships object describing relationships between the
     * resource and other JSON API resources
     * @param Links\Collection|null $links a links object containing links related to the resource
     * @param Meta\Collection|null $meta a meta object containing non-standard meta-information about a resource that
     * can not be represented as an attribute or relationship
     * @throws InvalidDataException
     */
    public function __construct(
        $type = null,
        $id = null,
        array $attributes = null,
        Relationships\Collection $relationships = null,
        Links\Collection $links = null,
        Meta\Collection $meta = null
    ) {
        if (
            (null === $type && null === $id) ||
            (null !== $type && !is_string($type))
        ) {
            throw new InvalidDataException;
        }
        $this->type = $type;
        $this->id = $id;
        $this->attributes = $attributes;
        $this->relationships = $relationships;
        $this->links = $links;
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return Relationships\Collection|null
     */
    public function getRelationshipsCollection()
    {
        return $this->relationships;
    }

    /**
     * @return Links\Collection|null
     */
    public function getLinksCollection()
    {
        return $this->links;
    }

    /**
     * @return Meta\Collection|null
     */
    public function getMetaCollection()
    {
        return $this->meta;
    }

    /**
     * Returns json encoded value or null
     * @return string|null
     */
    public function getAsJson()
    {
        return json_encode($this->getAsArray());
    }

    /**
     * Returns the json as array
     * @return array
     */
    public function getAsArray()
    {
        $data = [
            static::FIELD_TYPE => $this->getType(),
            static::FIELD_ID => $this->getId(),
            static::FIELD_ATTRIBUTES => $this->getAttributes(),
            static::FIELD_RELATIONSHIPS => null !== $this->getRelationshipsCollection() ?
                $this->getRelationshipsCollection()->getAsArray() : null,
            static::FIELD_LINKS => null !== $this->getLinksCollection() ?
                $this->getLinksCollection()->getAsArray() : null,
            static::FIELD_META => null !== $this->getMetaCollection() ?
                $this->getMetaCollection()->getAsArray() : null
        ];
        return [array_filter($data)];
    }
}

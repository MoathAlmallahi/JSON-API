<?php

namespace Json\Object;

use Json\Exceptions\InvalidJsonApiDataException;
use Json\IRecursively;
use Json\ISkeleton;
use Json\Object\Links;
use Json\Object\Meta;
use Json\Object\Relationships;

/**
 * Class Data
 * @package Json
 */
class Data implements ISkeleton, IRecursively
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
    public function getRelationships()
    {
        return $this->relationships;
    }

    /**
     * @return Links\Collection|null
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return Meta\Collection|null
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param string $type
     * @param mixed $id
     * @param array|null $attributes
     * @param Relationships\Collection|null $relationships
     * @param Links\Collection|null $links
     * @param Meta\Collection|null $meta
     * @throws InvalidJsonApiDataException
     */
    public function __construct(
        $type,
        $id,
        array $attributes = null,
        Relationships\Collection $relationships,
        Links\Collection $links,
        Meta\Collection $meta
    ) {
        if (
            (null === $type && null === $id) ||
            (null === $relationships && null === $links && null === $meta)
        ) {
            throw new InvalidJsonApiDataException;
        }
        $this->type = $type;
        $this->id = $id;
        $this->attributes = $attributes;
        $this->relationships = $relationships;
        $this->links = $links;
        $this->meta = $meta;
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
            static::FIELD_RELATIONSHIPS => $this->getRelationships()->getAsArray(),
            static::FIELD_LINKS => $this->getLinks()->getAsArray(),
            static::FIELD_META => $this->getMeta()->getAsArray()
        ];

        return array_filter($data);
    }
}

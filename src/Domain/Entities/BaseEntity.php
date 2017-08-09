<?php
namespace App\Domain\Entities;

use App\Domain\ValueObjects\Id;
use JsonSerializable;

class BaseEntity implements JsonSerializable
{
    /**
     * @var \App\Domain\ValueObjects\Id
     */
    protected $id;

    /**
     * @param \App\Domain\ValueObjects\Id $id
     */
    public function __construct(Id $id)
    {
        $this->setId($id);
    }

    /**
     * @return \App\Domain\ValueObjects\Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @param \App\Domain\ValueObjects\Id $id
     *
     * @return BaseEntity
     */
    public function setId(Id $id): BaseEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
        ];
    }
}
<?php
namespace App\Domain\ValueObjects;

use InvalidArgumentException;
use JsonSerializable;

class Id implements JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     *
     * @throws \InvalidArgumentException if $id is empty string
     */
    public function __construct(string $id)
    {
        $this->setId($id);
    }

    /**
     * @param string $id
     *
     * @throws \InvalidArgumentException if $id is an empty string
     *
     * @return $this
     */
    private function setId(string $id): Id
    {
        if (trim($id) === '') {
            throw new InvalidArgumentException('Id must be a non empty string');
        }

        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getId();
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return $this->getId();
    }

    /**
     * @param \App\Domain\ValueObjects\Id|null $candidateId
     *
     * @return bool
     */
    public function equals(?self $candidateId): bool
    {
        if ($candidateId === null) {
            return false;
        }

        return $this->getId() === $candidateId->getId();
    }
}
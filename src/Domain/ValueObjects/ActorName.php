<?php
namespace App\Domain\ValueObjects;

use InvalidArgumentException;
use JsonSerializable;

class ActorName implements JsonSerializable
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @param string $firstName
     * @param string $lastName
     *
     * @internal param string $name
     *
     */
    public function __construct(string $firstName, string $lastName)
    {
        if (trim($firstName) === '') {
            throw new InvalidArgumentException('First name cannot be an empty string');
        }

        if (trim($lastName) === '') {
            throw new InvalidArgumentException('Last name cannot be an empty string');
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getLastName() . ' ' . $this->getLastName();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
        ];
    }
}
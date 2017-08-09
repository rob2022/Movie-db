<?php
namespace App\Domain\ValueObjects;

use InvalidArgumentException;
use JsonSerializable;

class MovieTitle implements JsonSerializable
{
    /**
     * @var string
     */
    private $title;

    /**
     * @param string $title
     *
     * @throws \InvalidArgumentException if $title is a blank string
     */
    public function __construct(string $title)
    {
        if (trim($title) === '') {
            throw new InvalidArgumentException('Title must cannot be blank');
        }

        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getTitle();
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return $this->getTitle();
    }
}
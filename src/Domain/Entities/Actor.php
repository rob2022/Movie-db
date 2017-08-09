<?php
namespace App\Domain\Entities;

use App\Domain\ValueObjects\ActorName;
use Carbon\Carbon;
use DateTimeInterface;
use App\Domain\ValueObjects\Id;
use InvalidArgumentException;

class Actor extends BaseEntity
{
    /**
     * @var \App\Domain\ValueObjects\ActorName
     */
    private $name;

    /**
     * @var \DateTimeInterface
     */
    private $dateOfBirth;

    /**
     * @param \App\Domain\ValueObjects\Id $id
     * @param \App\Domain\ValueObjects\ActorName $name
     * @param \DateTimeInterface $dateOfBirth
     *
     * @throws \InvalidArgumentException if $dateOfBirth is past the present
     */
    public function __construct(
        Id $id,
        ActorName $name,
        DateTimeInterface $dateOfBirth
    ) {
        $this->setName($name);
        $this->setDateOfBirth($dateOfBirth);

        parent::__construct($id);
    }

    /**
     * @return \App\Domain\ValueObjects\ActorName
     */
    public function getName(): ActorName
    {
        return $this->name;
    }

    /**
     * @param \App\Domain\ValueObjects\ActorName $name
     *
     * @return $this
     */
    public function setName(ActorName $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDateOfBirth(): DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTimeInterface $dateOfBirth
     *
     * @throws \InvalidArgumentException if $dateOfBirth is past the present
     *
     * @return $this
     */
    public function setDateOfBirth(DateTimeInterface $dateOfBirth)
    {
        if ($dateOfBirth > Carbon::now()) {
            throw new InvalidArgumentException('Date of birth cannot be in the future');
        }

        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $output = [
            'name' => $this->getName(),
            'dateOfBirth' => $this->getDateOfBirth()->format('Y-m-d'),
        ];

        return array_merge(parent::jsonSerialize(), $output);
    }
}
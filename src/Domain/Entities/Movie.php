<?php
namespace App\Domain\Entities;

use Carbon\Carbon;
use DateTimeInterface;
use App\Domain\ValueObjects\Id;
use App\Domain\ValueObjects\MovieTitle;
use App\Domain\Collections\ActorCollection;
use InvalidArgumentException;

class Movie extends BaseEntity
{
    /**
     * @var \App\Domain\ValueObjects\MovieTitle
     */
    private $title;

    /**
     * @var \DateTimeInterface
     */
    private $releaseDate;

    /**
     * @var \App\Domain\Collections\ActorCollection
     */
    private $actors;

    /**
     * @param \App\Domain\ValueObjects\Id $id
     * @param \App\Domain\ValueObjects\MovieTitle $title
     * @param \DateTimeInterface $releaseDate
     * @param \App\Domain\Collections\ActorCollection $actors
     *
     * @throws \InvalidArgumentException if $releaseDate is in the future
     */
    public function __construct(
        Id $id,
        MovieTitle $title,
        DateTimeInterface $releaseDate,
        ActorCollection $actors
    ) {
        $this->setTitle($title);
        $this->setReleaseDate($releaseDate);
        $this->setActors($actors);

        parent::__construct($id);
    }

    /**
     * @return \App\Domain\ValueObjects\MovieTitle
     */
    public function getTitle(): MovieTitle
    {
        return $this->title;
    }

    /**
     * @param \App\Domain\ValueObjects\MovieTitle $title
     *
     * @return Movie
     */
    public function setTitle(MovieTitle $title): Movie
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReleaseDate(): DateTimeInterface
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTimeInterface $releaseDate
     *
     * @throws \InvalidArgumentException if $releaseDate is in the future
     *
     * @return Movie
     */
    public function setReleaseDate(DateTimeInterface $releaseDate): Movie
    {
        if (Carbon::now() < $releaseDate) {
            throw new InvalidArgumentException('ReleaseDate cannot be in the future');
        }

        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return \App\Domain\Collections\ActorCollection
     */
    public function getActors(): ActorCollection
    {
        return $this->actors;
    }

    /**
     * @param \App\Domain\Collections\ActorCollection $actors
     *
     * @return Movie
     */
    public function setActors(ActorCollection $actors): Movie
    {
        $this->actors = $actors;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $output = [
            'title' => $this->getTitle(),
            'releaseDate' => $this->getReleaseDate()->format('Y-m-d'),
            'actors' => $this->getActors(),
        ];

        return array_merge(parent::jsonSerialize(), $output);
    }
}
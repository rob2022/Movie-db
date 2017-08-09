<?php
namespace App\Domain\Collections;

use App\Domain\Entities\Actor;
use JsonSerializable;
use RuntimeException;

class ActorCollection implements JsonSerializable
{
    /**
     * @var \App\Domain\Entities\Actor[]
     */
    private $items = [];

    /**
     * @param \App\Domain\Entities\Actor[] ...$actors
     */
    public function __construct(Actor ...$actors)
    {
        $this->add(...$actors);
    }

    /**
     * @param \App\Domain\Entities\Actor[] ...$actors
     *
     * @throws \RuntimeException if an id is already in the collection
     *
     * @return $this
     */
    public function add(Actor ...$actors)
    {
        foreach ($actors as $actor) {
            foreach ($this->items as $item) {
                if ($actor->getId()->equals($item->getId())) {
                    throw new RuntimeException(
                        sprintf('Collection Already contains an Id of %s', $item->getId()));
                }
            }

            $this->items[] = $actor;
        }

        return $this;
    }

    /**
     * @return \App\Domain\Entities\Actor[]
     */
    public function jsonSerialize(): array
    {
        return $this->items;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return (bool) $this->items;
    }
}
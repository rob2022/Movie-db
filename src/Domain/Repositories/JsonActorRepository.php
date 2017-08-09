<?php
namespace App\Domain\Repositories;

use App\Domain\Builders\ActorBuilder;
use App\Domain\Collections\ActorCollection;
use App\Domain\ValueObjects\Id;

class JsonActorRepository extends BaseJsonRepository implements ActorRepository
{
    /**
     * @var \App\Domain\Builders\ActorBuilder
     */
    private $actorBuilder;

    /**
     * @param \App\Domain\Builders\ActorBuilder $actorBuilder
     */
    public function __construct(ActorBuilder $actorBuilder)
    {
        $this->actorBuilder = $actorBuilder;
    }

    /**
     * return string
     */
    protected function getJsonFileName(): string
    {
        return 'actors.json';
    }

    /**
     * @param \App\Domain\ValueObjects\Id[] ...$ids
     *
     * @return \App\Domain\Collections\ActorCollection
     */
    public function get(Id ...$ids): ActorCollection
    {
        $stringIds = array_map(function(Id $id) {
            return (string) $id;
        }, $ids);

        $actorCollection = new ActorCollection();

        foreach ($this->getJson() as $actorData) {
            if (in_array($actorData['id'], $stringIds, true)) {
                $actorCollection->add($this->actorBuilder->build($actorData));
            }
        }

        return $actorCollection;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return array_map(function(array $actorData) {
            return $this->actorBuilder->build($actorData);
        }, $this->getJson());
    }
}
<?php
namespace App\Domain\Builders;

use App\Domain\Entities\Movie;
use App\Domain\ValueObjects\Id;
use App\Domain\ValueObjects\MovieTitle;
use App\Domain\Repositories\ActorRepository;
use Carbon\Carbon;

class MovieBuilder
{
    /**
     * @var \App\Domain\Repositories\ActorRepository
     */
    private $actorRepository;

    /**
     * @param \App\Domain\Repositories\ActorRepository $actorRepository
     */
    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    /**
     * @param array $data
     *
     * @return \App\Domain\Entities\Movie
     */
    public function build(array $data) {
        $actorIds = array_map(function(string $id) {
            return new Id($id);
        }, $data['actors']);

        $actors = $this->actorRepository->get(...$actorIds);

        return new Movie(
            new Id($data['id']),
            new MovieTitle($data['title']),
            Carbon::createFromFormat('Y-m-d', $data['releaseDate']),
            $actors
        );
    }
}
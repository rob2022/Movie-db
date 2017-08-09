<?php
namespace App\Domain\Repositories;

use App\Domain\Entities\Movie;
use App\Domain\ValueObjects\Id;
use App\Domain\Builders\MovieBuilder;
use OutOfBoundsException;

class JsonMovieRepository extends BaseJsonRepository implements MovieRepository
{
    /**
     * @var \App\Domain\Builders\MovieBuilder
     */
    private $movieBuilder;

    /**
     * @param \App\Domain\Builders\MovieBuilder $movieBuilder
     */
    public function __construct(MovieBuilder $movieBuilder)
    {
        $this->movieBuilder = $movieBuilder;
    }

    /**
     * @param \App\Domain\ValueObjects\Id $id
     *
     * @throws \OutOfBoundsException if $id is not in repo
     *
     * @return \App\Domain\Entities\Movie
     */
    public function get(Id $id): Movie
    {
        foreach ($this->getJson() as $movie) {
            if ($movie['id'] === $id->getId()) {
                return $this->movieBuilder->build($movie);
            }
        }

        throw new OutOfBoundsException(sprintf('Movie with Id of %s not found', $id));
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return array_map(function(array $movieData) {
            return $this->movieBuilder->build($movieData);
        }, $this->getJson());
    }

    /**
     * @return string
     */
    protected function getJsonFileName(): string
    {
        return 'movies.json';
    }
}
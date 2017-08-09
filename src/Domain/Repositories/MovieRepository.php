<?php
namespace App\Domain\Repositories;

use App\Domain\Entities\Movie;
use App\Domain\ValueObjects\Id;

interface MovieRepository
{
    /**
     * @param \App\Domain\ValueObjects\Id $id
     *
     * @return \App\Domain\Entities\Movie
     */
    public function get(Id $id): Movie;

    /**
     * @return array
     */
    public function getAll(): array;
}
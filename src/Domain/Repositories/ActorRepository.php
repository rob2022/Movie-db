<?php
namespace App\Domain\Repositories;

use App\Domain\Collections\ActorCollection;
use App\Domain\ValueObjects\Id;

interface ActorRepository
{
    /**
     * @param \App\Domain\ValueObjects\Id[] ...$ids
     *
     * @return \App\Domain\Collections\ActorCollection
     */
    public function get(Id ...$ids): ActorCollection;
}
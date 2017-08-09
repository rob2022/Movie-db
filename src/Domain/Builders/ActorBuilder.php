<?php
namespace App\Domain\Builders;

use App\Domain\Entities\Actor;
use App\Domain\ValueObjects\ActorName;
use App\Domain\ValueObjects\Id;
use Carbon\Carbon;

class ActorBuilder
{
    /**
     * @param array $data
     *
     * @return \App\Domain\Entities\Actor
     */
    public function build(array $data): Actor
    {
        return new Actor(
            new Id($data['id']),
            new ActorName($data['firstName'], $data['lastName']),
            Carbon::createFromFormat('Y-m-d', $data['dateOfBirth'])
        );
    }
}
<?php
use App\Domain\Builders\ActorBuilder;
use App\Domain\Builders\MovieBuilder;
use App\Domain\Repositories\JsonActorRepository;
use App\Domain\Repositories\JsonMovieRepository;
use Slim\Container;

// DIC configuration

$container = $app->getContainer();

$container['actorRepository'] = function () {
    return new JsonActorRepository(
        new ActorBuilder()
    );
};

$container['movieRepository'] = function (Container $c) {
    return new JsonMovieRepository(
        new MovieBuilder($c->get('actorRepository'))
    );
};

<?php
namespace App\Controllers;

use App\Domain\ValueObjects\Id;
use OutOfBoundsException;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class MovieController
{
    /**
     * @var \App\Domain\Repositories\MovieRepository
     */
    private $movieRepository;

    /**
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->movieRepository = $container->get('movieRepository');
    }

    /**
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     *
     * @return \Slim\Http\Response
     */
    public function show(Request $request, Response $response, array $args): Response
    {
        try{
            $movie = $this->movieRepository->get(new Id($args['id']));
        } catch (OutOfBoundsException $e) {
            return $response->withStatus(404);
        }

        return $response->withJson($movie);
    }

    /**
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     *
     * @return \Slim\Http\Response
     */
    public function index(Request $request, Response $response, array $args): Response
    {
        $movies = $this->movieRepository->getAll();

        return $response->withJson($movies);
    }
}
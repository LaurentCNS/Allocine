<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewActorsController extends AbstractController
{
    public function __construct(
        private ActorRepository $actorRepository)
{}
    #[Route('/view/actors/{movieId}/{actorId}', name: 'app_view_actors')]
    public function index($movieId, $actorId): Response
    {

        // recuperer l'acteur par rapport à son id
        $actorEntity = $this->actorRepository->find($actorId);

        // recuperer les films de l'acteur
        $movies = $actorEntity->getMovies();


        return $this->render('view_actors/index.html.twig', [
            'controller_name' => 'ViewActorsController',
            'actor' => $actorEntity,
            'movies' => $movies,
            'returnMovieId' => $movieId
        ]);
    }
}

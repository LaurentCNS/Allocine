<?php

namespace App\Controller;

use App\Repository\DirectorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewDirectorController extends AbstractController
{

    public function __construct(
        private DirectorRepository $directorRepository)
{}
    #[Route('/view/director/{movieId}/{directorId}', name: 'app_view_director')]
    public function index($movieId, $directorId): Response
    {

        // recuperer le realisateur par rapport à son id
        $directorEntity = $this->directorRepository->find($directorId);

        // recuperer les films du realisateur
        $movies = $directorEntity->getMovies();


        return $this->render('view_director/index.html.twig', [
            'controller_name' => 'ViewDirectorController',
            'director' => $directorEntity,
            'movies' => $movies,
            'returnMovieId' => $movieId
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListMoviesController extends AbstractController
{
    public function __construct(
        private MovieRepository $movieRepository
    )
{}

    #[Route('/list/movies', name: 'app_list_movies')]
    public function index(): Response
    {

        // recuperer les films de la base de données
        $moviesEntities = $this->movieRepository->findAll();

        

        return $this->render('list_movies/index.html.twig', [
            'controller_name' => 'ListMoviesController',
            'movies' => $moviesEntities            
        ]);
    }
}

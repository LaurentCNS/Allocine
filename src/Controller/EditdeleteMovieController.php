<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditdeleteMovieController extends AbstractController
{
    #[Route('/editdelete/movie', name: 'app_editdelete_movie')]
    public function index(): Response
    {

        // recuperer tout les films
        $moviesEntities = $this->movieRepository->findAll();

        return $this->render('editdelete_movie/index.html.twig', [
            'controller_name' => 'EditdeleteMovieController',
            'movies' => $moviesEntities
        ]);
    }
}

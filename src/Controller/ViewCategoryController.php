<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewCategoryController extends AbstractController
{
    public function __construct(
        private MovieRepository $movieRepository,
        private CategoryRepository $categoryRepository
    )
{}

    #[Route('/view/category/{movieId}/{categoryId}', name: 'app_view_category')]
    public function index($movieId, $categoryId): Response
    {

        // Recuperer la categorie par rapport à son id
        $categoryEntity = $this->categoryRepository->find($categoryId);

        // Recuperer les films de la categorie
        $movies = $categoryEntity->getMovies();





        return $this->render('view_category/index.html.twig', [
            'controller_name' => 'ViewCategoryController',
            'category' => $categoryEntity,
            'movies' => $movies,
            'returnMovieId' => $movieId
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewMovieController extends AbstractController
{
    public function __construct(
        private MovieRepository $movieRepository
    )
    {}

    #[Route('/view/movie/{movieId}', name: 'app_view_movie')]
    public function index($movieId): Response
    {

        // recuperer le film par rapport à son id
        $movieEntity = $this->movieRepository->find($movieId);

        // recuperer les categories du film
        $categories = $movieEntity->getCategories();

        // recuperer les acteurs du film
        $actors = $movieEntity->getActors();
        


        // faire une boucle sur toutes les notes du film
        $reviews = $movieEntity->getReviews();

        if(count($reviews) > 0) {
            $reviews_count = 0;
            $reviews_sum = 0;
                foreach ($reviews as $item) {
                    $reviews_count++;
                    $reviews_sum += $item->getNote();
                }
            $reviews_average = number_format(($reviews_sum / $reviews_count),1);
        }



        return $this->render('view_movie/index.html.twig', [
            'controller_name' => 'ViewMovieController',
            'movie' => $movieEntity,
            'categories' => $categories,
            'actors' => $actors,
            'reviews_average' => $reviews_average
        ]);
    }
}

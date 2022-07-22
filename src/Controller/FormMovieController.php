<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Review;
use App\Form\MovieType;
use App\Form\ReviewType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormMovieController extends AbstractController
{
    public function __construct(        
	  private EntityManagerInterface $entityManager,
      private MovieRepository $movieRepository,
    )
{}
    
    #[Route('/form/movie', name: 'app_form_movie')]
    public function index(Request $request): Response
    { 
        $isFormUpdate = false;

        $movie = new Movie();

        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
           
            $this->entityManager->persist($movie);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_form_movie');
        }


        return $this->render('form_movie/index.html.twig', [
            'controller_name' => 'FormMovieController',
            'form' => $form->createView(),
            'isFormUpdate' => $isFormUpdate,
        ]);
    }


    #[Route('/form/review/{id}', name: 'app_form_review')]
    public function reviewForm(Request $request, $id): Response
    { 


        $review = new Review();

        $user = $this->getUser();
      
        $review->setUser($user);
        
        $review->setCreatedAt(new \DateTime());
        $this->entityManager->persist($review);
        


        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {         
           
            $this->entityManager->persist($review);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_form_movie');
        }


        return $this->render('form_review/index.html.twig', [
            'controller_name' => 'FormReviewController',
            'form' => $form->createView(),
        ]);
    }


    
    
}

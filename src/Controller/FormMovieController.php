<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
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
        ]);
    }

    
    
}

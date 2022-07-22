<?php

namespace App\Controller;

use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditdeleteMovieController extends AbstractController
{
    public function __construct(        
        private EntityManagerInterface $entityManager,
        private MovieRepository $movieRepository,
      )
  {}
    #[Route('/editdelete/movie', name: 'app_editdelete_movie')]
    public function index(): Response
    {

        $isFormUpdate = false;

        // recuperer tout les films
        $moviesEntities = $this->movieRepository->findAll();

        return $this->render('editdelete_movie/index.html.twig', [
            'controller_name' => 'EditdeleteMovieController',
            'movies' => $moviesEntities
        ]);
    }

    #[Route('/edit/movie/{id}', name: 'app_edit_movie')]
    public function update(Request $request, $id): Response
    {

        // recuperer le film par son id
        $movieEntity = $this->movieRepository->find($id);

        $form = $this->createForm(MovieType::class, $movieEntity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
           
            $this->entityManager->persist($movieEntity);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_form_movie');
        }


        return $this->render('form_movie/index.html.twig', [
            'controller_name' => 'FormMovieController',
            'form' => $form->createView(),
            'isFormUpdate' => true,
        ]);
    }

    #[Route('/delete/movie/{id}', name: 'app_delete_movie')]
    public function delete($id): Response
    {

        // recuperer le film par son id
        $movieEntity = $this->movieRepository->find($id);


        if($movieEntity != null) {
            $this->entityManager->remove($movieEntity);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_editdelete_movie');
        }

    }

}

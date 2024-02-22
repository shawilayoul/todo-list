<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesControllersController extends AbstractController
{
    #[Route('/movies/controllers', name: 'app_movies_controllers')]
    public function index(): Response
    {
        return $this->render('movies_controllers/index.html.twig', [
            'controller_name' => 'MoviesControllersController',
        ]);
    }
}
